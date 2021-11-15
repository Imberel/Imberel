<?php

namespace Imberel\Imberel\Core\Session;

use Imberel\Imberel\Core\Connection\Connection;
use Imberel\Imberel\Core\Handler\SessionHandler;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class DatabaseSession extends SessionHandler
{
    public string $table;

    public \PDO $pdo;

    public Connection $connection;

    public string|null $userid = null;

    public int $remember = 0;

    public function __construct()
    {
        $this->table = collect('SESSION_TABLE');
        parent::__construct();
        $this->connection = new Connection;
        $this->pdo = $this->connection->pdo();
    }

    public function write(string $id, object|array|null $data = null): bool
    {
        $session = $this->read($id);
        if (empty(USER_SESSION_ID)) {
            return false;
        }

        if ($session === false) {
            $this->insertSess($id);
            return true;
        }

        if (\is_null($session->userid)) {
            $this->updateId($id, USER_SESSION_ID);
        }

        if ($session->remember === 0 && $this->remember === 1) {
            $this->updateRemember($id);
        }

        if (!\is_null($data)) {
            $this->updateData($id, $data);
        }

        return $this->updateSess($id);
    }

    public function read(string $id): object|bool
    {
        $statement = "SELECT * FROM $this->table WHERE id = :id";
        $stmt =  $this->pdo->prepare($statement);
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            new ICatch($th, 'Session');
        }
        return $stmt->fetchObject();
    }

    public function destroy(string $id): bool
    {
        $statement = "DELETE FROM $this->table WHERE id = :id";
        $stmt =  $this->pdo->prepare($statement);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function gc(int $max): bool
    {
        $old = \time() - \intval($max);
        $statement = "DELETE FROM $this->table WHERE access < :old AND remember = :remember";
        $stmt =  $this->pdo->prepare($statement);
        $stmt->bindValue(':old', $old);
        $stmt->bindValue(':remember', $this->remember);
        return $stmt->execute();
    }
    public function set(string $userid, int $remember): bool
    {
        $this->userid = $userid;
        $this->remember = $remember;
        $this->write(USER_SESSION_ID);
        return true;
    }

    public function get(): string
    {
        return $this->read(USER_SESSION_ID)->userid;
    }

    public function guest(string $id): bool
    {
        return \is_null($this->read($id)->userid);
    }

    public function updateId(string $id, string $userid): bool
    {
        $statement = "UPDATE $this->table SET userid = :userid WHERE id = :id";
        $stmt =  $this->pdo->prepare($statement);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':userid', $this->userid);
        return $stmt->execute();
    }

    public function updateData(string $id, object|array $data): bool
    {
        $statement = "UPDATE $this->table SET data = :data WHERE id = :id";
        $stmt =  $this->pdo->prepare($statement);
        $stmt->bindValue(':data', $data);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function insertSess(string $id): bool
    {
        $values = [
            'id' => $id,
            'userid' => null,
            'access' => time(),
            'remember' => $this->remember,
            'user_agent' => collect('HTTP_USER_AGENT'),
            'data' => null
        ];
        $params = '';
        foreach ($values as $key => $item) {
            if ($key === \array_key_last($values)) {
                $params .= ":$key";
            } else {
                $params .= ":$key, ";
            }
        }
        $statement = "INSERT INTO $this->table VALUES ($params)";
        $stmt =  $this->pdo->prepare($statement);
        foreach ($values as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    public function updateSess(string $id): bool
    {
        $values = [
            'id' => $id,
            'access' => time(),
            'remember' => $this->remember,
            'user_agent' => collect('HTTP_USER_AGENT'),
            'data' => null
        ];
        $keys = '';
        foreach ($values as $key => $item) {
            if ($key === \array_key_last($values)) {
                $keys .= "$key = :$key";
            } else {
                $keys .= "$key = :$key, ";
            }
        }
        $statement = "UPDATE $this->table SET $keys  WHERE id = :id";
        $stmt =  $this->pdo->prepare($statement);
        foreach ($values as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    public function updateRemember(string $id, int $remember = 1): bool
    {
        $statement = "UPDATE $this->table SET remember = :remember WHERE id = :id";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':remember', $remember);
        return $stmt->execute();
    }

    public function storage(): bool
    {
        $statement = "CREATE TABLE IF NOT EXISTS $this->table (
                    `id` VARCHAR(100) NOT NULL,
                    `userid` VARCHAR(25) DEFAULT NULL,
                    `access` INT(15) UNSIGNED DEFAULT NULL,
                    `remember` TINYINT DEFAULT 0,
                    `user_agent` VARCHAR(250) DEFAULT NULL,
                    `data` TEXT,
                    PRIMARY KEY(`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        return $this->pdo->exec($statement);
    }
}