<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Core\Application\Authenticate;
use Imberel\Imberel\Core\Extra\Random;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Register extends Authenticate
{
    public string $useremail = '';

    public string $userid;

    public string $username = '';

    public string $firstname = '';

    public string $lastname = '';

    public int $userstatus;

    public string $password = '';

    public string $confirmpassword = '';

    public function __construct()
    {
        parent::__construct();
        $randid = new Random;
        $this->userid = $randid->string(10);
    }

    public function attributes(): array
    {
        return ['userid', 'useremail', 'username', 'firstname', 'lastname', 'userstatus', 'password'];
    }
    public function tableName(): string
    {
        return 'users';
    }

    public function labels(): array
    {
        return [
            'useremail' => 'Email Address',
            'username' => 'Username',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'password' => 'Password',
            'confirmpassword' => 'Confirm Password'
        ];
    }

    public function rules(): array
    {
        return [
            'useremail' => [self::REQUIRED, self::EMAIL, [self::UNIQUE, 'class' => self::class]],
            'username' => [self::REQUIRED, [self::MIN, 'min' => 5], [self::MAX, 'max' => 25], [self::UNIQUE, 'class' => self::class]],
            'firstname' => [self::REQUIRED],
            'lastname' => [self::REQUIRED],
            'password' => [self::REQUIRED, [self::MIN, 'min' => 8], [self::MAX, 'max' => 250]],
            'confirmpassword' => [self::REQUIRED, [self::MATCH, 'match' => 'password']]
        ];
    }

    public function register()
    {
        if ($this->request->isPost()) {
            $this->load($this->request->body());
            if ($this->validate()) {
                $this->userstatus = self::INACTIVE;
                $this->password = password_hash($this->password, PASSWORD_DEFAULT);
                $this->save();
                $this->response->redirect("/login");
            }
        }
        return;
    }

    public function save()
    {
        $table = $this->tableName();
        $attributes = $this->attributes();
        $params = \array_map(fn ($attr) => ":$attr", $attributes);
        $stmt = $this->prepare("INSERT INTO $table (" . \implode(",", $attributes) . ") 
        VALUES (" . \implode(",", $params) . ")");
        foreach ($attributes as $attibute) {
            $stmt->bindValue(":$attibute", $this->{$attibute});
        }
        $stmt->execute();
        return true;
    }

    public function key(): string|null
    {
        return null;
    }
}