<?php

namespace BackupTool\Service;


use Symfony\Component\Console\Output\OutputInterface;

class UploadManager extends BaseManager
{
    public function uploadArtifact(OutputInterface $output, string $config, string $repo, string $file):string {
        // Load Config
        $loadedConfig = $this->getContainer('app.config_loader')->loadConfig($config);
        // Parse Config
        $repoConfig =  $this->getContainer('app.config_manager')->getRepoConfig($loadedConfig, $repo);
        // Get Repo Service
        $repoService = $this->getContainer('repo.service_factory')->getRepoService($repoConfig);
        // Create Repo Manager
        $repoManager = $this->getContainer('repo.repo_manager');

        // Upload File to repo

    }
}