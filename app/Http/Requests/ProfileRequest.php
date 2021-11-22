<?php

namespace Imberel\Imberel\Http\Requests;

use Imberel\Imberel\Core\Application\Authenticate;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class ProfileRequest extends Authenticate
{
    public function rules(): array
    {
        return [
            'firstname' => [self::REQUIRED],
            'lastname' => [self::REQUIRED],
            'password' => [self::REQUIRED, [self::VERIFY, 'class' => self::class, 'attribute' => $this->userid]],
        ];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
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