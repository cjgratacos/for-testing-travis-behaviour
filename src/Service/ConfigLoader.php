<?php

namespace BackupTool\Service;

use BackupTool\Model\ConfigModel;
use Symfony\Component\Yaml\Yaml;
use BackupTool\Exception\InvalidExtension;

class ConfigLoader{
    private $cwd;

    function __construct(){
        $this->cwd = getcwd();
    }

    public function loadConfig(string $filename){
      return $this->readConfig($filename);
    }

    private function readConfig($fileName){

        $fullFilePath = $this->cwd .'/'. $fileName;
        $fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
        switch (strtolower($fileExtension)) {
          case 'yml':
            return Yaml::parse(file_get_contents($fullFilePath));
          case 'json':
            return json_decode(file_get_contents($fullFilePath));
          default:
            throw new InvalidExtension($fileExtension);
        }
    }
}

