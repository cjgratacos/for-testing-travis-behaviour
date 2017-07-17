<?php

namespace BackupTool\Exception;

use \Exception;
use Throwable;

class InvalidTypeException extends Exception
{
    public function __construct(string $type, string $source, int $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf("Unsupported type `%s` for `%s`: There is no service for managing the requested type.", $type, $source), $code, $previous);
    }

}