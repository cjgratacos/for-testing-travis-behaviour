<?php

namespace BackupTool\Service\DB;


use BackupTool\Exception\InvalidDbTypeException;
use BackupTool\Exception\InvalidTypeException;
use BackupTool\Model\DbConfig;
use BackupTool\Service\DB\SQL\SqlDbService;

class DbServiceFactory
{
    public function getDbService(DbConfig $config): IDbService {
        switch (strtolower($config->getType())) {
            case 'mysql':
                return new SqlDbService('pdo_mysql', $config->getCredentials());
            default:
                throw new InvalidTypeException($config->getType(), 'db');
        }
    }
}