<?php
/**
 * Created by PhpStorm.
 * User: carlosgr
 * Date: 6/26/17
 * Time: 4:40 PM
 */

namespace BackupTool\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class BackupDbToRepoCommand extends ContainerAwareCommand
{
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
        parent::__construct();
    }

    protected function configure(){
        $this
            ->setName('db:dump-repo')
            ->setDescription('Creates a Backup db-bak file of a DB and upload it to a Repo.')
            ->setHelp('This Command creates a backup db-bak file of a DB and upload it to a repo.')
        ;

        $this
            ->addArgument("config", InputArgument::REQUIRED, "The JSON/YAML file that contains the configuration for reading the source DB." )
            ->addArgument("source", InputArgument::REQUIRED, "The name of the source DB in the configuration file.")
            ->addArgument("repo", InputArgument::REQUIRED, "The name of the Repo in the configuration file.")
            ->addArgument("filename", InputArgument::OPTIONAL, "The filename which the backup DB File will have, don't include extension. It will default to: <source-db-name>_<date>.db-bak")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        try{
            $config = $input->getArgument("config");
            $source = $input->getArgument("source");
            $repo = $input->getArgument("repo");
            $filename = $input->getArgument("filename");

            $this->getContainer()->get('app.backup_manager')->backupToArtifact($output, $config, $source, $filename);
            $this->getContainer()->get('app.upload_manager')->uploadArtifact($output, $config, $repo, $filename);

        } catch (\Exception $ex) {
            $output->write("ERROR: ".$ex->getMessage());
        }
    }
}