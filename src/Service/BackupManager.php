<?php

namespace BackupTool\Service;

use Symfony\Component\Console\Output\OutputInterface;

class BackupManager extends BaseManager
{

    public function backupToArtifact(OutputInterface $output, string $config, string $source, string $file):string {
        // Load Config
        $loadedConfig = $this->getContainer('app.config_loader')->loadConfig($config);
        // Parse Config
        $dbConfig =  $this->getContainer('app.config_manager')->getDbConfig($loadedConfig, $source);
        // Get DB Service
        $dbService = $this->getContainer('db.service_factory')->getDbService($dbConfig);

        // Create DB Manager
        $dbManager = $this->getContainer('db.db_manager');

        $filename = ($file?:$dbConfig->getCredentials()->getDb().'_'.date('m-d-y_G-i-s', time())).'.db-bak';

        $dbManager->isValid($dbService);
        $dbManager->backupDb($dbService, $filename, $output);

        $output->writeln(sprintf(PHP_EOL."Finished backing up %s:%s into %s successfully.".PHP_EOL, $dbConfig->getType(), $source, $filename));

        return $filename;
    }

}