<?php

namespace BackupTool\Exception;

use \Exception;
use Throwable;

class InvalidExtension extends Exception{

  public function __construct(string $extension, int $code = 0,Throwable $previous = null) {
    parent::__construct(sprintf("Files with extension %s are not supported.",$extension),$code,$previous);
  }

}