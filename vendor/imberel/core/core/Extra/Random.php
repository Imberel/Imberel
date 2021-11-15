<?php

namespace Imberel\Imberel\Core\Extra;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
/**
 *  Generate Characters for Specified Length
 *  And Ensures Generated Starts with a random uppercase
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 * @package Extra
 */
class Random
{
    /**
     * String to be return
     * 
     *
     * @var string
     */
    private string $random = "";

    private const UPPERCASE = "ABCDEFGHIJKLMNOPQRSTUVWXYJ";

    private const CHARACTSERSINTEGERS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmopqrstuvwxyz0123456789";

    /**
     * Genrate Random Strings
     * If tReplace with a random UpperCase
     * @param integer $length
     *
     * @return string
     */
    private function generate(int $length): string
    {
        $single = $this->uppercase();

        if ($length === 1) {
            return $single;
        }

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen(self::CHARACTSERSINTEGERS) - 1);
            $this->random .= self::CHARACTSERSINTEGERS[$index];
        }

        foreach ($this->integers as $integer) {
            if (\str_starts_with($this->random, $integer)) {
                $this->random = \str_replace($integer, $single, $this->random);
            }
        }

        foreach ($this->lowercase as $lowercase) {
            if (\str_starts_with($this->random, $lowercase)) {
                $this->random = \ucfirst($this->random);
            }
        }

        return $this->random;
    }

    /**
     * Generate a random UpperCase Character
     *
     * @return string
     */
    public function uppercase(): string
    {
        $index = rand(0, strlen(self::UPPERCASE) - 1);
        return self::UPPERCASE[$index];
    }

    /**
     * Undocumented function
     *
     * @param integer $length
     *
     * @return string
     */
    public function string(int $length): string
    {
        return $this->generate($length);
    }

    /**
     * And Array of Integers used in running checks
     *
     * @var array
     */
    private array $integers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

    /**
     * And array of lowercase used in running Checks
     *
     * @var array
     */
    private array $lowercase = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
}