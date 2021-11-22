<?php

namespace Imberel\Imberel\Http\Requests;

use Imberel\Imberel\Core\Application\Authenticate;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class UsernameRequest extends Authenticate
{
    public function rules(): array
    {
        return [
            'username' => [self::VERIFY, [self::MIN, 'min' => 5], [self::MAX, 'max' => 25], [self::UNIQUE, 'class' => self::class]],
            'password' => [self::REQUIRED, [self::VERIFY, 'class' => self::class, 'attribute' => $this->userid]],

        ];
    }

    public function labels(): array
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public function table(): string
    {
        return 'users';
    }

    public function key(): string
    {
        return "userid";
    }
}