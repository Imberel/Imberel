<?php

namespace Imberel\Imberel\Core\Connection;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Construct
{
    /**
     * Database Variable
     *
     * @var string|null
     */
    protected string|null $dbDriver;


    /**
     * Database Variable
     *
     * @var string|null
     */
    protected string|null $dbHost;

    /**
     * Database Variable
     *
     * @var string|null
     */
    protected string|null $dbPort;

    /**
     * Database Variable
     *
     * @var string|null
     */
    protected string|null $dbName;

    /**
     * Database Variable
     *
     * @var string|null
     */
    protected string|null $dbUser;

    /**
     * Database Variable
     *
     * @var string|null
     */
    protected string|null $dbPassword;

    /**
     * Database Variable
     *
     * @var string|null
     */
    protected string|null $DSN;

    public function __construct()
    {
        $this->dbDriver();
        $this->dbHost();
        $this->dbPort();
        $this->dbName();
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbDriver(): string
    {
        return $this->dbDriver = collect('DATABASE_DRIVER');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbHost(): string
    {
        return $this->dbHost = collect('DATABASE_HOST');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbPort(): string
    {
        return $this->dbPort = collect('DATABASE_PORT');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbName(): string
    {
        return $this->dbName = collect('DATABASE_NAME');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbUser(): string
    {
        return $this->dbUser = collect('DATABASE_USER');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbPassword(): string
    {
        return $this->dbPassword = collect('DATABASE_PASSWORD');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function DSN(): string
    {
        return $this->DSN = $this->dbDriver . ":host=" . $this->dbHost . ";port=" . $this->dbPort . ";dbname=" . $this->dbName;
    }
}
