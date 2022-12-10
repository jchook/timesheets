<?php

namespace Jchook\Timesheets\Textual\Render;

use Jchook\Timesheets\Ast\Timesheet;

interface RendererInterface
{
  public function renderTimesheets(array $timesheets): string;
  public function renderTimesheet(Timesheet $timesheet): string;
}
