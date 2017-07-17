<?php

namespace BackupTool\Model;


class RepoConfig
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var RepoCredentials
     */
    private $credentials;

    function __construct(string $type, array $credentials)
    {
        $this->type = $type;
        $this->credentials = new RepoCredentials((object) $credentials);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return RepoCredentials
     */
    public function getCredentials(): RepoCredentials
    {
        return $this->credentials;
    }


}