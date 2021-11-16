<?php

namespace Imberel\Imberel\Core\Validation;

use Imberel\Imberel\Core\Connection\Connection;
use Imberel\Imberel\Core\Interface\Validation;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class Validator extends Connection implements Validation
{

    public function validate(): mixed
    {
        $this->interate();
        return empty($this->errors);
    }

    public function interate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            if (\is_array($rules)) {
                foreach ($rules as $rule) {
                    $ruleName = $rule;
                    if (\is_array($rule)) {
                        $ruleName = $rule[0];
                    }
                    $this->check($ruleName, $value, $rule, $attribute);
                }
            }
        }
        return;
    }

    public function check(string $ruleName, string $value, mixed $rule, mixed $attribute)
    {
        if ($ruleName === self::REQUIRED && !$value) {
            $this->addError($attribute, self::REQUIRED, ['attr' => $this->getLabel($attribute), 'value' => self::REQUIRED]);
        }
        if ($ruleName === self::EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($attribute, self::EMAIL, ['value' => $value, 'email' => self::EMAIL]);
        }
        if ($ruleName === self::MIN && strlen($value) < $rule['min']) {
            $this->addError($attribute, self::MIN, [$rule, 'label' => $this->getLabel($attribute)]);
        }
        if ($ruleName === self::MAX && strlen($value) > $rule['max']) {
            $this->addError($attribute, self::MAX, [$rule, 'label' => $this->getLabel($attribute)]);
        }
        if ($ruleName === self::MATCH && $value !== $this->{$rule['match']}) {
            $rule['match'] = $this->getLabel($rule['match']);
            $this->addError($attribute, self::MATCH, [$rule, 'label' => $this->getLabel($attribute)]);
        }
        if ($ruleName === self::UNIQUE) {
            $class = $rule['class'];
            $uniqueAttr = $attribute;
            $table = $class::tableName();
            $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $uniqueAttr = :attr");
            $stmt->bindValue(":attr", $value);
            $stmt->execute();
            if ($stmt->fetchObject()) {
                $this->addError($attribute, self::UNIQUE, ['value' => $value]);
            }
        }
        if ($ruleName === self::EXISTS) {
            $class = $rule['class'];
            $table = $class::tableName();
            $stmt = $this->pdo->prepare("SELECT $attribute FROM $table WHERE $attribute = :attr");
            $stmt->bindValue(":attr", $value);
            $stmt->execute();
            if (!$stmt->fetchObject()) {
                $this->addError($attribute, self::EXISTS, ['value' => $value, 'exist' => self::EXISTS]);
            }
        }
        if ($ruleName === self::VERIFY) {
            $class = $rule['class'];
            $table = $class::tableName();
            $password = 'password';
            $where = $this->key();
            if (!empty($rule['attribute']) && empty($this->errors)) {
                $stmt = $this->pdo->prepare("SELECT $attribute FROM $table WHERE $where = :attr");
                $stmt->bindValue(":attr", $rule['attribute']);
                $stmt->execute();
                if ($attribute === $password || \str_contains($attribute, $password)) {
                    if (!password_verify($value, $stmt->fetchObject()->$attribute)) {
                        $this->addError($attribute, self::VERIFY, ['value' => $value, 'label' => $this->getLabel($attribute)]);
                    }
                    return;
                }
                if ($attribute !== $stmt->fetchObject()->$attribute) {
                    $this->addError($attribute, self::VERIFY, ['value' => $value, 'label' => $this->getLabel($attribute)]);
                }
            }
        }
        return;
    }

    /**
     * Return a Defined Label for the Given Attribute
     * If not Set Returns Back the Attribute
     *
     * @param string $attribute
     *
     * @return string|array
     */
    public function getLabel(string $attribute): string|array
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    /**
     * Labels For Attributes
     *
     * @return array
     */
    abstract public function labels(): array;

    abstract public function key(): string|null;
}