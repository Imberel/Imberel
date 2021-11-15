<?php

namespace Imberel\Imberel\Core\Dotenv;

use Imberel\Imberel\Core\Extra\ICatch;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Dotenv
{
    private const INVALIDKEYSTRINGPATTERN = "/[a-z]/u";

    private const INVALIDKEYINTPATTERN = "/[0-9]/u";

    private const REQUIREDSEPERATOR = "/=/u";

    private const SEPERATOR = "=";

    private const WHHITESPACE = "/ /u";

    private const VALIDENVTYPE = "/.env/";

    private const PACKAGENAME = ".imbereldotenv";

    private const QUOTE = "'";

    private const DOUBLEQUOTE = '"';

    private const EMPTY = "";

    private const COMMENT = "//";

    private const VARIABLEDOLLARPATTERN = "/$/";

    /**
     * Initializing
     *
     * @param string|null $envPath
     * @param string|array|null|null $addPaths
     */
    public function __construct(string|null $envPath, string|array|null $addPaths = null)
    {
        try {
            $this->check($envPath, $addPaths);
        } catch (\Throwable $th) {
            new ICatch($th, "Dotenv");
        }
    }

    /**
     * Check through the provided types
     * To determine how to load
     *
     * @param mixed $envpath
     * @param mixed $addpaths
     *
     * @return void
     */
    private function check(mixed $envpath, mixed $addpaths): void
    {
        if (\is_array($envpath)) {
            throw new \TypeError("First Argument must be String, ( " . $envpath . " ) Given");
        }

        if (isset($addpaths) && \is_string($addpaths)) {
            $this->load($envpath);
            $this->load($addpaths);
            return;
        }

        if (isset($addpaths) && \is_array($addpaths)) {
            $this->load($envpath);
            foreach ($addpaths as $path) {
                if (\is_array($path)) {
                    foreach ($path as $item) {
                        $this->load($item);
                    }
                } else {
                    $this->load($path);
                }
            }
            return;
        }

        $this->load($envpath);
        return;
    }

    /**
     * Get the file name from the provided
     * And send for reading
     *
     * @param mixed $envpath
     *
     * @return void
     */
    private function load(mixed $envpath): void
    {
        if (!\is_string($envpath)) {
            throw new \Exception("Error Processing Request");
        }

        if (\is_dir($envpath)) {
            throw new \Exception("Expecting file, Directory found ( $envpath )");
        }

        $filename = pathinfo($envpath . self::PACKAGENAME, PATHINFO_FILENAME);
        $err_filename = pathinfo($envpath, PATHINFO_BASENAME);
        if (!\preg_match(self::VALIDENVTYPE, $filename)) {
            throw new \Exception("( $err_filename ) is not a valid ENV file type");
        }

        $this->read($envpath);
        return;

        throw new \Exception("Error Processing Request");
    }

    /**
     * Read the file found in the provided path
     *
     * @param string $file
     *
     * @return void
     */
    private function read(string $file): void
    {
        if (\is_readable($file)) {
            $this->parse(\file_get_contents($file));
            return;
        }

        throw new \Exception("Unable to read file (" . \pathinfo($file, PATHINFO_BASENAME) . ") Check file path / name");
    }

    /**
     * Parse the file content 
     *
     * @param string $filecontent
     *
     * @return void
     */
    private function parse(string $filecontent): void
    {
        $exploded = \explode("\n", $filecontent);
        foreach ($exploded as $item) {
            if (empty($item)) {
                continue;
            }
            if (\str_starts_with($item, self::COMMENT)) {
                continue;
            }
            $this->convert($item);
        }
    }

    /**
     * Convert Content of the parse file
     * Break them into keys and values
     * Arrange them into and array
     * Reading to be sent to the SuperGlobals
     *
     * @param string $heystack
     *
     * @return void
     */
    private function convert(string $heystack): void
    {
        $this->validate($heystack);
        $position = \strpos($heystack, self::SEPERATOR);
        $key = \substr($heystack, 0, $position);
        $value = \substr($heystack, $position + 1, \strlen($heystack));
        $this->populate([$this->sanitzeKey($key) => $this->sanitizeValue($value)]);
    }

    /**
     * Before the file content is Converted
     * The contents needs to pass certain rules
     *
     * @param string $value
     *
     * @return void
     */
    private function validate(string $value): void
    {
        if (!\preg_match(self::REQUIREDSEPERATOR, $value)) {
            throw new \Exception("( " . $value . " ) is invalid, Solution: add ( = )");
        }
        return;
    }

    /**
     * Do some sanitization on the keys
     *
     * @param string $key
     *
     * @return string 
     */
    private function sanitzeKey(string $key): string
    {
        $this->validateKey(\trim($key));
        return $key;
    }

    /**
     * Do some sanitization on the values
     *
     * @param string $value
     *
     * @return string
     */
    private function sanitizeValue(string $value): string
    {
        $this->valiadateValue(\trim($value));
        if (\str_starts_with($value, self::QUOTE) && \str_ends_with($value, self::QUOTE)) {
            $value = \str_replace(self::QUOTE, self::EMPTY, $value);
        }

        return \trim($value);
    }

    /**
     * Validate provided keys
     * To ensure the meet requirements
     * Needed to be Superglobal keys
     *
     * @param string $key
     *
     * @return string
     */
    private function validateKey(string $key): string
    {
        if (\preg_match_all(self::INVALIDKEYSTRINGPATTERN, $key)) {
            throw new \Error("ENV key (" . $key . ") must be UPPERCASE");
        }

        if (\preg_match_all(self::INVALIDKEYINTPATTERN, $key)) {
            throw new \Error("ENV key (" . $key . ") contain Integer(s)");
        }

        if (\preg_match_all(self::WHHITESPACE, $key)) {
            throw new \Error("ENV key (" . $key . ") contain whitespace(s)");
        }

        foreach ($this->inValidChars as $item) {
            if (\str_contains($key, $item)) {
                throw new \Error("ENV key (" . $key . ") contain this symbol => ( " . $item . " ) remove it");
            }
        }

        return $key;
    }

    /**
     * Validate the values extracted
     * If fails Gives Suggestions
     *
     * @param string $value
     *
     * @return void
     */
    private function valiadateValue(string $value): void
    {
        if (\preg_match(self::WHHITESPACE, $value) && \str_starts_with($value, self::QUOTE) && !\str_ends_with($value, self::QUOTE)) {
            throw new \Exception("ENV value ( " . $value . " ) start quote unmatched, Solution => ( " . $value . self::QUOTE . " )");
        }

        if (\preg_match(self::WHHITESPACE, $value) && !\str_starts_with($value, self::QUOTE) && \str_ends_with($value, self::QUOTE)) {
            throw new \Exception("ENV value ( " . $value . " ) end quote unmatched, Solution => ( " . self::QUOTE . $value . " )");
        }

        if (\preg_match(self::WHHITESPACE, $value) && !\str_starts_with($value, self::QUOTE) && !\str_ends_with($value, self::QUOTE)) {
            throw new \Exception("ENV value ( " . $value . " ) contains whitespace, escape with single quotes => ( " . self::QUOTE . $value . self::QUOTE . " )");
        }

        if (!\preg_match(self::WHHITESPACE, $value) && \str_contains($value, self::QUOTE)) {
            throw new \Exception("ENV value ( " . $value . " ) is invalid, Solution => ( " . \str_replace(self::QUOTE, self::EMPTY, $value) . " )");
        }

        return;
    }

    /**
     * For every Key and Value Gotten 
     * Load to Each of the SuperGlobals
     *
     * @param array $values
     *
     * @return void
     */
    private function populate(array $values): void
    {
        foreach ($values as $key => $value) {
            $value = $this->variable($value);
            $this->loadPutenv($key, $value);
        }
        return;
    }

    /**
     * Loading to getenv
     *
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    private function loadPutenv(string $key, string $value): void
    {
        \putenv("$key=$value");
        return;
    }

    /**
     * Checks id Value is a Variable
     *
     * @param  string $value
     *
     * @return string
     */
    public function variable(string $value): string
    {
        if (\preg_match(self::VARIABLEDOLLARPATTERN, $value) && \str_contains($value, "{") && \str_contains($value, "}")) {
            $value = \str_replace(self::DOUBLEQUOTE, self::EMPTY, $value);
            $value = \substr($value, 2, \strlen($value));
            $value = \str_replace("}", self::EMPTY, $value);
            return $value;
        }

        return $value;
    }

    /**
     * List of Invalid characters to be filtered
     *
     * @var array
     * @author Binkap S <real.desert.tiger@gmail.com>
     */
    private array $inValidChars = [
        "-",
        "`",
        "~",
        "!",
        "@",
        "#",
        "$",
        "%",
        "^",
        "&",
        "*",
        "(",
        ")",
        "=",
        "+",
        "{",
        "}",
        "[",
        "]",
        ":",
        ";",
        "'",
        '"',
        "<",
        ">",
        ",",
        ".",
        "?",
        "/",
        "|",
        "\\",
    ];
}