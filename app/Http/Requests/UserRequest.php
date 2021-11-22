<?php

namespace Imberel\Imberel\Http\Requests;

use Imberel\Imberel\Core\Application\Model;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class UserRequest extends Model
{
    public function table(): string
    {
        return 'users';
    }

    public function key(): string
    {
        return "userid";
    }
}