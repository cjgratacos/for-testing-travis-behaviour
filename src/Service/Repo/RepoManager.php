<?php

namespace BackupTool\Service\Repo;

use BackupTool\Exception\InvalidConnectionException;
use BackupTool\Exception\FileIOException;

class RepoManager
{
    public function isValid(IRepoService $repoService):bool {
        try {
            $repoService->isValidRepo();
        }catch (Exception $exception) {
            throw new InvalidConnectionException("Repo", 0, $exception);
        }

        return true;
    }

    public function uploadArtifact(IRepoService $repoService, string $fileName, string $endpoint):void {
        try{
            // Get Full File URI
            $filePath = getcwd();
            $fullFileName = $filePath . '/' . $fileName;
            
            // Validate File Exists.
            if (!file_exists($fullFileName))
             {
                 // If File doesn't exist throw an error.
                 throw new FileIOException(
                    "Validation",
                    $fileName,
                    "File already exist inside $filePath. Please remove it before backing up."
                );
            }
            
            $repoService->uploadBackup($fullFileName, $endpoint);
            
        }catch (Exception $exception){
            throw new DbBackupException("error happened while trying to backup into file: $fileName", 0, $exception);
        }
    }
}