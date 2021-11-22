<?php

namespace Imberel\Imberel\Http\Requests;

use Imberel\Imberel\Core\Application\Authenticate;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class ResetPasswordRequest extends Authenticate
{
    public function table(): string
    {
        return 'password_reset';
    }

    public function rules(): array
    {
        return [
            //'useremail' => [self::REQUIRED, self::EMAIL, [self::EXISTS, 'class' => self::class]]
        ];
    }

    public function labels(): array
    {
        return [
            'useremail' => 'Email Address'
        ];
    }

    public function key(): string
    {
        return "useremail";
    }
}