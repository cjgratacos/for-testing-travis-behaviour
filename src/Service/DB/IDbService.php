<?php

namespace BackupTool\Service\DB;

use Symfony\Component\Console\Output\OutputInterface;

interface IDbService {
    function isConnectionValid():bool;
    function backup(OutputInterface $output, $resource):void;
    function upload($resource):void;

}