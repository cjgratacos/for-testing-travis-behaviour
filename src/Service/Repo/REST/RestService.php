<?php

namespace BackupTool\Service\Repo\REST;

use BackupTool\Service\Repo\IRepoService;

class RestService implements IRepoService
{
    function isValidRepo(): bool
    {
        // TODO: Implement isValidRepo() method.
    }

    function uploadBackup(string $fullFileName, string $endpoint): void
    {
        // TODO: Implement uploadBackup() method.
    }

    function downloadBackup(string $saveFullFileName, string $downloadEndpointPath): void
    {
        // TODO: Implement downloadBackup() method.
    }

}