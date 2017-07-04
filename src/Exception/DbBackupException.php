<?php
/**
 * Created by PhpStorm.
 * User: carlosgr
 * Date: 6/26/17
 * Time: 9:01 AM
 */

namespace BackupTool\Exception;

use \Exception;
use Throwable;

class DbBackupException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Error while backing up DB: $message", $code, $previous);
    }

}