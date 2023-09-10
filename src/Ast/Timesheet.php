<?php

namespace Jchook\Timesheets\Ast;

use DateTimeInterface;

/**
 * Represents a timesheet for a single day
 */
class Timesheet
{
  /**
   * @param Entry[] $entires
   */
  public function __construct(
    public DateTimeInterface $date,
    public array $entries,
  )
  {
  }
}

