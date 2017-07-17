<?php

namespace BackupTool\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class BaseManager
{
    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function getContainer(string $containerName):object {
        return $this->container->get($containerName);
    }
}