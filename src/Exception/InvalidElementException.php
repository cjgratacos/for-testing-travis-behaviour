<?php

namespace BackupTool\Exception;

use \Exception;
use Throwable;

class InvalidElementException extends Exception {
  public function __construct(string $element, $code = 0, Throwable $previous = null)
  {
    parent::__construct(sprintf("Element %s was not found.",$element), $code, $previous);
  }

}