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
            'username' => [self::VERIFY, [self::MIN, 'min' => 5]],
            'password' => [self::REQUIRED, [self::VERIFY, 'class' => self::class, 'attribute' => $this->userid]]
        ];
    }

    public function labels(): array
    {
        return [];
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