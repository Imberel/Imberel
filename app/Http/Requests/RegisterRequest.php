<?php

namespace Imberel\Imberel\Http\Requests;

use Imberel\Imberel\Core\Application\Authenticate;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class RegisterRequest extends Authenticate
{
    public function table(): string
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

    public function key(): string|null
    {
        return null;
    }
}