<?php

namespace Imberel\Imberel\Core\Interface;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
interface Validation
{
    public const INACTIVE = 0;

    public const ACTIVE = 1;

    public const DELETED = 2;

    public const REQUIRED = 'required';

    public const EMAIL = 'email address';

    public const UNIQUE = 'unique';

    public const MIN = 'min';

    public const MAX = 'max';

    public const MATCH = 'match';

    public const EXISTS = 'exists';

    public const VERIFY = 'verify';

    public function rules(): array;

    public function errors(): array;

    public function validate(): mixed;

    public function addError(string $attribute, string $rule, array $parems): void;

    public function getError(string $attribute): string|bool;
}