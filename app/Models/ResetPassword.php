<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Core\Application\Model;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class ResetPassword extends Model
{
    public string $useremail = '';

    public string $password = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function reset()
    {
        return true;
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