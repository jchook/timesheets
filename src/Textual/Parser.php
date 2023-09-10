<?php

namespace Jchook\Timesheets\Textual;

use DateTimeImmutable;
use DateTimeInterface;
use Jchook\Timesheets\Ast\Entry;
use Jchook\Timesheets\Ast\Timesheet;
use RuntimeException;

/**
 * Regex-based parser for timesheet files
 */
class Parser
{
  const DEFAULT_HOURS_PATTERN = '@' .

    // # Project Name
    '^#\s+([A-Za-z0-9\-_ ]+)\n+' .

    // - List of billable activity
    '((?:^-.+\n+)+)' .

    // 1h (duration in hours)
    '([0-9.]+)h\s*\n' .

    // Multiline and case-insensitive
    '@mi'
  ;

  public function __construct(
    public string $hoursPattern = self::DEFAULT_HOURS_PATTERN,
  )
  {}

  public function parseTimesheetFile(string $path): Timesheet
  {
    $dateStr = pathinfo($path, PATHINFO_FILENAME);
    $date = new DateTimeImmutable($dateStr);
    $doc = file_get_contents($path);
    return $this->parseTimesheet($date, $doc);
  }

  public function parseTimesheet(DateTimeInterface $date, string $doc): Timesheet
  {
    error_clear_last();
    $matched = preg_match_all($this->hoursPattern, $doc, $matches, PREG_SET_ORDER);
    if ($matched === false) {
      $err = error_get_last();
      if ($err) {
        throw new RuntimeException('An error occurred while parsing a timesheet: ' . $err['message']);
      } else {
        throw new RuntimeException('An unknown error has occured while parsing a timesheet');
      }
    }
    if (!$matched) {
      return new Timesheet($date, []);
    }
    $entries = [];
    foreach ($matches as $match) {
      [, $projectName, $description, $hours] = $match;
      $entries[] = new Entry(trim($projectName), floatval($hours), $description);
    }
    return new Timesheet($date, $entries);
  }
}
