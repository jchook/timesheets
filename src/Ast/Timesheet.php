<?php

namespace Jchook\Timesheets\Ast;

use DateTimeInterface;

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

