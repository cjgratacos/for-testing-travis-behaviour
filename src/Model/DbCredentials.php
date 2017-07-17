<?php

namespace BackupTool\Model;


class DbCredentials
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
     * @var string
     */
    private $db;

    /**
     * DbCredentials constructor.
     * @param object $credentials
     */
    public function __construct(\stdClass $credentials)
    {
        $this->username = $credentials->username;
        $this->password = $credentials->password;
        $this->host = $credentials->host;
        $this->port = $credentials->port;
        $this->db = $credentials->database;
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
     * @return string
     */
    public function getDb(): string
    {
        return $this->db;
    }
}