<?php

namespace BackupTool;

use BackupTool\Command\BackupDbToRepoCommand;
use BackupTool\Command\DumpToFileBackupCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class App extends Application{

  /**
   * This variable exist in the Application Class. It is set here for readability and shadowing purposes.
   * @var ContainerBuilder
   */
  private $container;

  static function init():void{
      $application = new App();
      $application->run();
  }

  function __construct(){
    // Manually Creating Container Builder
    $this->container = new ContainerBuilder();

    // Useful Paths
    $paths = [];
    $paths['root'] = __DIR__ . '/../';
    $paths['config'] = $paths['root'] . 'app/config/';

    // Save useful parameter in the Container Bundle
    $this->container->setParameter('paths', $paths);

    // Create a YAML File Loader
    $loader = new YamlFileLoader($this->container, new FileLocator($paths['config']));

    // Load config.yml under the $path[config] route
    $loader->load('config.yml');

    // Compile Container, Verify and Validate for no errors or Circular Dependencies
    $this->container->compile();

    // Get Parameters located in the config.yml
    $app = $this->container->getParameter('application');

    // Parent Constructor
    parent::__construct($app['name'],$app['version']);

    // Load Application Command
    $this->loadCommands();
  }

  private function loadCommands():void{
    // Loading all the commands
    $this->add(new DumpToFileBackupCommand($this->container));
    $this->add(new BackupDbToRepoCommand($this->container));

  }
}




