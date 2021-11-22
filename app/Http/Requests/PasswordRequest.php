<?php

namespace Imberel\Imberel\Http\Requests;

use Imberel\Imberel\Core\Application\Authenticate;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class PasswordRequest extends Authenticate
{
    public function rules(): array
    {
        return [
            'password' => [self::REQUIRED, [self::VERIFY, 'class' => self::class, 'attribute' => $this->userid]],
            'newPassword' => [self::REQUIRED, [self::MIN, 'min' => 8]],
            'confirmPassword' => [self::REQUIRED, [self::MATCH, 'match' => 'newPassword']]

        ];
    }

    public function labels(): array
    {
        return [
            'password' => 'Password',
            'newPassword' => 'New Password',
            'confirmPassword' => 'Confirm Password'
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