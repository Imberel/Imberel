<?php

namespace Imberel\Imberel\Http\Requests;

use Imberel\Imberel\Core\Application\Authenticate;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class LoginRequest extends Authenticate
{
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

    public function tableName(): string
    {
        return 'users';
    }

    public function key(): string
    {
        return "useremail";
    }
}