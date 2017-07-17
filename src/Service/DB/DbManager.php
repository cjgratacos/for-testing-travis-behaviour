<?php

namespace BackupTool\Service\DB;

use BackupTool\Exception\DbBackupException;
use BackupTool\Exception\InvalidConnectionException;
use \Exception;
use Symfony\Component\Console\Output\OutputInterface;

class DbManager
{
    public function isValid(IDbService $dbService):bool {
        try{
            $dbService->isConnectionValid();
        } catch (Exception $exception){
            throw new InvalidConnectionException('DB', 0,$exception);
        }
        return true;
    }

    public function backupDb(IDbService $dbService, string $fileName, OutputInterface $output):void {
        try{
            $filePath = getcwd();
            $fullFileName = $filePath . '/' . $fileName;
            if (file_exists($fullFileName)) throw new \Exception("File $fileName already exist inside $filePath. Please remove it before backing up.");
            $fo = fopen($fullFileName, 'x');
            $dbService->backup($output,$fo);
        }catch (DbBackupException $exception){
            throw new DbBackupException("error happened while trying to backup into file: $fileName", 0, $exception);
        }
    }
}