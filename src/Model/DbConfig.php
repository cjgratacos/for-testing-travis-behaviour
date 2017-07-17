<?php

namespace BackupTool\Model;


class DbConfig
{
    private $type;
    private $credentials;

    function __construct(string $type, array $credentials)
    {
        $this->type = $type;
        $this->credentials = new DbCredentials((object)$credentials);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return DbCredentials
     */
    public function getCredentials(): DbCredentials
    {
        return $this->credentials;
    }

}