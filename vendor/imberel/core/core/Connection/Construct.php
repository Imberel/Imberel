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
        return $this->dbDriver = getenv('DATABASE_DRIVER');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbHost(): string
    {
        return $this->dbHost = getenv('DATABASE_HOST');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbPort(): string
    {
        return $this->dbPort = getenv('DATABASE_PORT');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbName(): string
    {
        return $this->dbName = getenv('DATABASE_NAME');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbUser(): string
    {
        return $this->dbUser = getenv('DATABASE_USER');
    }

    /**
     * Construct Database Credential
     *
     * @return string
     */
    public function dbPassword(): string
    {
        return $this->dbPassword = getenv('DATABASE_PASSWORD');
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