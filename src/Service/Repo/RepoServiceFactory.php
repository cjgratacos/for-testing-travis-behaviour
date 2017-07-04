<?php

namespace BackupTool\Service\Repo;

use BackupTool\Exception\InvalidTypeException;
use BackupTool\Model\RepoConfig;
use BackupTool\Service\Repo\REST\RestService;

class RepoServiceFactory
{
    public function getRepoService(RepoConfig $config):IRepoService {
        switch (strtolower($config->getType())) {
            case 'rest':
                return new RestService($config->getCredentials());
            default:
                throw new InvalidTypeException($config->getType(), 'repo');
        }
    }
}