<?php

namespace BackupTool\Service\Repo;

use BackupTool\Exception\InvalidConnectionException;
use \Exception;

class RepoManager
{
    public function isValid(IRepoService $repoService):bool {
        try {

        }catch (Exception $exception) {
            throw new InvalidConnectionException("Repo", 0, $exception);
        }

        return true;
    }

    public function uploadArtifact(IRepoService $repoService, string $fileName):void {
        try{
            $filePath = getcwd();
            $fullFileName = $filePath . '/' . $fileName;
            if (!file_exists($fullFileName)) throw new \Exception("File $fileName already exist inside $filePath. Please remove it before backing up.");
            $fo = fopen($fullFileName, 'x');
            $dbService->backup($output,$fo);
        }catch (Exception $exception){
            throw new DbBackupException("error happened while trying to backup into file: $fileName", 0, $exception);
        }
    }
}