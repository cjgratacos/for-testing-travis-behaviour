<?php

namespace BackupTool\Model;

use \stdClass;

class RepoCredentials
{

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $port;

    /**
     * @var array
     */
    private $extra;

    /**
     * RepoCredentials constructor.
     * @param stdClass $credentials
     */
    function __construct(stdClass $credentials)
    {
        $this->username = $credentials->username;
        $this->password = $credentials->password;
        $this->host = $credentials->host;
        $this->port = $credentials->port;
        $this->extra = $credentials->extra;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }

    /**
     * @return array
     */
    public function getExtra(): array
    {
        return $this->extra;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getFromExtra(string $name): string {
        return $this->extra[$name];
    }
}