<?php

namespace Jchook\Timesheets\Ast;

class Entry
{
  public function __construct(
    public string $projectName,
    public float $hours,
    public string $description,
  )
  {}
}

