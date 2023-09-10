<?php

namespace Jchook\Timesheets\Ast;

/**
 * Represents one time entry for a timesheet
 */
class Entry
{
  public function __construct(
    public string $projectName,
    public float $hours,
    public string $description,
  )
  {}
}

