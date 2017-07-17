<?php

class RoboFile extends \Robo\Tasks
{
    function toolPhar(){
        $this->_exec('./phar-builder.phar package composer.json');
    }

    function runTest(){
        $this->_exec("SERVER_PORT=9000 SERVER_NAME=127.0.0.1 php -dxdebug.remote_autostart=On init.php backup 1 2 3");
    }
}