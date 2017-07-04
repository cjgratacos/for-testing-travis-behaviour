<?php

namespace BackupTool\Service;


use BackupTool\Exception\InvalidElementException;
use BackupTool\Model\ConfigDbModel;
use BackupTool\Model\DbConfig;
use BackupTool\Model\DbCredentials;
use BackupTool\Model\RepoConfig;
use BackupTool\Service\DB\DbDriverFactory;
use BackupTool\Service\DB\IDbService;

class ConfigManager {

    public function getDbConfig(array $config, string $dbName):DbConfig {
      $this->validateKeysExist($config, $dbName, 'db');

      return new DbConfig(
          $config['db'][$dbName]['type'],
          $config['db'][$dbName]['credentials']
      );
  }

  private function validateKeysExist(array $config, string $name, string $type):void {

      if(!array_key_exists($type, $config)){
          throw new InvalidElementException(sprintf("`%s`", $type));
      }

      if(!array_key_exists($name,$config[$type])){
          throw new InvalidElementException(sprintf("`%s on %s`",$name, $type));
      }

      if(!array_key_exists('type', $config[$type][$name])){
          throw new InvalidElementException(sprintf("`type inside %s on %s`",$name, $type));
      }

      if(!array_key_exists('credentials', $config[$type][$name])){
          throw new InvalidElementException(sprintf("`credentials inside %s on %s`",$name, $type));
      }
  }

  public function getRepoConfig(array $config, string $repositoryName):RepoConfig {
        $this->validateKeysExist($config, $repositoryName, 'repo');
        return new RepoConfig(
            $config['repo'][$repositoryName]['type'],
            $config['repo'][$repositoryName]['credentials']
        );
    }
}