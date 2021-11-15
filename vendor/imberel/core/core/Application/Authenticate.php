<?php

namespace Imberel\Imberel\Core\Application;

use Imberel\Imberel\Core\Request\Request;
use Imberel\Imberel\Core\Response\Response;
use Imberel\Imberel\Core\Validation\Validator;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class Authenticate extends Validator
{

    public Request $request;

    public  Response $response;

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request;
        $this->response = new Response;
    }

    /**
     * Loads Database
     *
     * @param array $data
     *
     * @return void
     */
    public function load(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Array of How Errors be Displayed
     *
     * @return array
     */
    public function errors(): array
    {
        return [
            self::REQUIRED => "{{attr}} is {{value}}",
            self::EMAIL => "{{value}} is not a valid {{email}}",
            self::UNIQUE => "{{value}} is already in use",
            self::MIN => "{{label}} should be atleast {{min}} characters",
            self::MAX => "{{label}} should be less than {{max}} characters",
            self::MATCH => "{{label}} must match {{match}}",
            self::EXISTS => "{{value}} does not {{exist}}",
            self::VERIFY => "Incorrect {{label}}"
        ];
    }

    /**
     * Append Errors to the errors array
     *
     * @param string $attribute
     * @param string $rule
     * @param array $params
     *
     * @return void
     */
    public function addError(string $attribute, string $rule, array $params = []): void
    {
        $message = $this->errors()[$rule] ?? '';
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key => $item) {
                    $message = str_replace("{{{$key}}}", $item, $message);
                }
            } else {
                $message = str_replace("{{{$key}}}", $value, $message);
            }
        }
        $this->errors[$attribute][] = $message;
    }

    /**
     * Return Error For the Given Attribute
     *
     * @param string $attribute
     *
     * @return string|boolean
     */
    public function getError(string $attribute): string|bool
    {
        foreach ($this->errors[$attribute] as $error) {
            return $error ?? false;
        }
    }


    /**
     * Check if there is an Error For the Given attribute
     *
     * @param string $attribute
     *
     * @return array|boolean
     */
    public function hasError(string $attribute): array|bool
    {
        return $this->errors[$attribute] ?? false;
    }

    abstract public function tableName(): string;

    abstract public function attributes(): array;
}
