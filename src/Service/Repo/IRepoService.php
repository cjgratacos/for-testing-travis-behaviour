<?php

namespace BackupTool\Service\Repo;


interface IRepoService
{
   function isValidRepo():bool ;
   function uploadBackup(string $fullFileName, string $endpoint):void ;
   function downloadBackup(string $saveFullFileName, string $downloadEndpointPath):void ;

}