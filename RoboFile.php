<?php

use \Robo\Tasks;

class RoboFile extends Tasks
{
    function buildPhar(){
        $this->_exec('./phar-builder.phar package composer.json');
    }

    function runPhar(){

    }

    function runTest(){
        $this->_exec("init.php db:dump 1 2 3");
    }
}