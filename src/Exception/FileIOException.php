<?php

namespace BackupTool\Exception;

use \Exception;
use Throwable;

class FileIOException extends Exception
{
    public function __construct(string $operation, string $fileName, string $message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(printf("Failed performing %s on %s. %s", $operation, $fileName, $message), $code, $previous);
    }

}