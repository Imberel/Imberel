<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Core\Session\Session;
use Imberel\Imberel\Core\Application\Core;
use Imberel\Imberel\Core\Application\Model;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Login extends Model
{
    public Session $session;

    public string $useremail = '';

    public string $password = '';

    public function __construct()
    {
        parent::__construct();
        $this->session = Core::$core->session;
    }

    public function login()
    {
        if ($this->request->isPost()) {
            $this->load($this->request->body());
            if ($this->validate()) {
                $user = $this->getUser();
                $key = $this->key();
                $value = $user->{$key};
                $this->session->set($value, 1);
                $this->response->redirect("/user");
            }
        }
        return;
    }

    public function getUser(): object
    {
        $table = $this->tableName();
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE useremail = :attr");
        $stmt->bindValue(":attr", $this->useremail);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['useremail', 'password'];
    }

    public function rules(): array
    {
        return [
            'useremail' => [self::REQUIRED, self::EMAIL, [self::EXISTS, 'class' => self::class]],
            'password' => [self::REQUIRED, [self::VERIFY, 'class' => self::class, 'attribute' => $this->useremail]]
        ];
    }

    public function labels(): array
    {
        return [
            'useremail' => 'Email Address',
            'password' => 'Password'
        ];
    }

    public function key(): string
    {
        return "userid";
    }
}