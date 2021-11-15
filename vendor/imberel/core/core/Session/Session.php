<?php

namespace Imberel\Imberel\Core\Session;

use SessionHandlerInterface;
use Imberel\Imberel\Core\Extra\ICatch;
use Imberel\Imberel\Core\Connection\Connection;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Session extends Connection implements SessionHandlerInterface
{
    public string $table = SESSION_TABLE;

    public string|null $userid = null;

    public int $remember = 0;

    public int $access;

    public string $userAgent;

    public function __construct()
    {
        \error_reporting(E_ERROR);
        parent::__construct();
        \session_set_save_handler(
            [$this, "open"],
            [$this, "close"],
            [$this, "write"],
            [$this, "read"],
            [$this, "destroy"],
            [$this, "gc"]
        );
        \session_name(collect('SESSID_NAME'));
        \session_start();
        \restore_error_handler();
    }

    public function open($path, $name)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($id): mixed
    {
        $statement = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindValue(":id", $id);
        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            new ICatch($th);
        }
        return $stmt->fetchObject();
    }

    public function write($id, $data = null)
    {
        $sessionId = $this->read($id);
        if ($sessionId === false) {
            return $this->insert($id, $data);
        }

        if (\is_null($sessionId->userid)) {
            $this->updateId($id);
        }

        $this->updateSess($id, $data);
        return;
    }

    public function insert($id, $data)
    {
        $this->access = time();
        $statement = "INSERT INTO $this->table VALUES (:id, :userid, :access, :remember, :user_agent, :data)";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":userid", $this->userid);
        $stmt->bindValue(":access", $this->access);
        $stmt->bindValue(":remember", $this->remember);
        $stmt->bindValue(":data", $data);
        $stmt->bindValue(":user_agent", collect('HTTP_USER_AGENT'));
        return $stmt->execute();
    }

    public function updateId($id)
    {
        $statement = "UPDATE $this->table SET userid = :userid, remember = :remember WHERE id = :id";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindValue(":userid", $this->userid);
        $stmt->bindValue(":remember", $this->remember);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }

    public function updateSess($id, $data)
    {
        $this->access = time();
        $statement = "UPDATE $this->table SET id = :id, access = :access, user_agent = :user_agent, data = :data WHERE id = :id";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":data", $data);
        $stmt->bindValue(":user_agent", collect('HTTP_USER_AGENT'));
        $stmt->bindValue(":access", $this->access);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }

    public function destroy($id)
    {
        $statement = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }


    public function gc($max)
    {
        $old = time() - $max;
        $statement = "DELETE FROM $this->table WHERE access < :old AND remember = :remember";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindValue(":old", $old);
        $stmt->bindValue(":remember", $this->remember);
        return $stmt->execute();
    }

    public function set(string $key, int $remember)
    {
        $this->userid = $key;
        $this->remember = $remember;
        $this->write(USER_SESSION_ID);
    }

    public function get()
    {
        return $this->read(USER_SESSION_ID)->userid;
    }

    public function guest(string $id)
    {
        return \is_null($this->read($id)->userid);
    }
}
