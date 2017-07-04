<?php

namespace BackupTool\Command;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class DumpToFileBackupCommand extends ContainerAwareCommand {

    public function __construct(ContainerInterface $container)
    {
      $this->setContainer($container);
      parent::__construct();
    }

  protected function configure(){
        $this
            ->setName('db:dump')
            ->setDescription('Creates a Backup db-bak file of a DB')
            ->setHelp('This Command creates a backup db-bak file of a DB.')
        ;

        $this
            ->addArgument("config", InputArgument::REQUIRED, "The JSON/YAML file that contains the configuration for reading the source DB." )
            ->addArgument("source", InputArgument::REQUIRED, "The name of the source DB in the configuration file.")
            ->addArgument("filename", InputArgument::OPTIONAL, "The filename which the backup DB File will have, don't include extension. It will default to: <source-db-name>_<date>.db-bak")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output){
      try{

          // Get Arguments
          $config = $input->getArgument("config");
          $source = $input->getArgument("source");
          $filename = $input->getArgument("filename");

          // Generate Backup
          $this->getContainer()->get('app.backup_manager')->backupToArtifact($output, $config, $source, $filename);

      } catch (\Exception $ex) {
          $output->write("ERROR: ".$ex->getMessage());
      }
    }
}
