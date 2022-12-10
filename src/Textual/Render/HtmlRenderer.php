<?php

namespace Jchook\Timesheets\Textual\Render;

use Jchook\Timesheets\Ast\Timesheet;

class HtmlRenderer implements RendererInterface
{
  public function renderTimesheets(array $timesheets): string
  {
    $html = [];
    foreach ($timesheets as $timesheet) {
      $html[] = $this->renderTimesheet($timesheet);
    }
    return implode("\n", $html);
  }

  public function renderTimesheet(Timesheet $timesheet): string
  {
    $html = [];
    $hoursSum = array_sum(array_map(fn ($e) => $e->hours, $timesheet->entries));
    $html[] = '<h1>' . $timesheet->date->format('Y-m-d') . ': <small>' . $hoursSum . 'h</small></h1>';
    foreach ($timesheet->entries as $entry) {
      $html[] = "<h2>{$entry->projectName}</h2>";
      $html[] = "<pre>{$entry->description}</pre>";
      $html[] = "<p>{$entry->hours}h</p>";
    }
    return implode("\n", $html);
  }

  public function renderInLayout(string $content): string
  {
    return <<<HTML
      <!DOCTYPE html>
      <html>
        <head>
          <title>Timesheets</title>
        </head>
        <body>{$content}</body>
      </html>
    HTML;
  }
}

