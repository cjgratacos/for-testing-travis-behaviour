<?php

namespace BackupTool\Exception;

use \Exception;
use Throwable;

class InvalidConnectionException extends Exception
{

    public function __construct(string $type, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf("Error Connecting to `%s`", $type), $code, $previous);
    }
}