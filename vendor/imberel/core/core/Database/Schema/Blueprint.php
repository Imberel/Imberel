<?php

namespace Imberel\Imberel\Core\Database\Schema;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Blueprint
{
    public function int(string $name): string
    {
        return "`$name` INT";
    }

    public function tinyint(string $name): string
    {
        return "`$name` TINYINT";
    }

    public function smallint(string $name): string
    {
        return "`$name` SMALLINT";
    }

    public function mediumint(string $name): string
    {
        return "`$name` MEDIUMINT";
    }

    public function bigint(string $name): string
    {
        return "`$name` BIGINT";
    }

    public function decimal(string $name): string
    {
        return "`$name` DECIMAL";
    }

    public function float(string $name): string
    {
        return "`$name` FLOAT";
    }

    public function real(string $name): string
    {
        return "`$name` REAL";
    }

    public function double(string $name): string
    {
        return "`$name` DOUBLE";
    }

    public function bit(string $name): string
    {
        return "`$name` BIT";
    }

    public function boolean(string $name): string
    {
        return "`$name` BOOLEAN";
    }

    public function serial(string $name): string
    {
        return "`$name` SERIAL";
    }

    public function date(string $name): string
    {
        return "`$name` DATE";
    }

    public function datetime(string $name): string
    {
        return "`$name` DATETIME";
    }

    public function timestamp(string $name): string
    {
        return "`$name` TIMESTAMP";
    }

    public function time(string $name): string
    {
        return "`$name` TIME";
    }

    public function year(string $name): string
    {
        return "`$name` YEAR";
    }

    public function char(string $name): string
    {
        return "`$name` CHAR";
    }

    public function varchar(string $name): string
    {
        return "`$name` VARCHAR";
    }

    public function text(string $name): string
    {
        return "`$name` TEXT";
    }

    public function tinytext(string $name): string
    {
        return "`$name` TINYTEXT";
    }

    public function mediumtext(string $name): string
    {
        return "`$name` MEDIUNTEXT";
    }

    public function lontext(string $name): string
    {
        return "`$name` LONGTEXT";
    }

    public function binary(string $name): string
    {
        return "`$name` BINARY";
    }

    public function varbinary(string $name): string
    {
        return "`$name` VARBINARY";
    }

    public function tinyblob(string $name): string
    {
        return "`$name` TINYBLOB";
    }

    public function blob(string $name): string
    {
        return "`$name` BLOB";
    }

    public function mediumblob(string $name): string
    {
        return "`$name` MEDIUMBLOB";
    }

    public function longblob(string $name): string
    {
        return "`$name` LONGBLOB";
    }

    public function enum(string $name): string
    {
        return "`$name` ENUM";
    }

    public function set(string $name): string
    {
        return "`$name` SET";
    }

    public function geometry(string $name): string
    {
        return "`$name` GEOMETRY";
    }

    public function point(string $name): string
    {
        return "`$name` POINT";
    }

    public function linestring(string $name): string
    {
        return "`$name` LINESTRING";
    }

    public function polygon(string $name): string
    {
        return "`$name` POLYGON";
    }

    public function multipoint(string $name): string
    {
        return "`$name` MULTIPOINT";
    }

    public function multilinestring(string $name): string
    {
        return "`$name` MULTILINESTRING";
    }

    public function multipolygon(string $name): string
    {
        return "`$name` MULTIPOLYGON";
    }

    public function geometrycollection(string $name): string
    {
        return "`$name` GEOMETRYCOLLECTION";
    }

    public function json(string $name): string
    {
        return "`$name` JSON";
    }

    public function primary(): string
    {
        return "PRIMARY KEY";
    }

    public function autoincreament(): string
    {
        return "AUTO INCREAMENT";
    }

    public function unique(): string
    {
        return "UNIQUE";
    }

    public function nullable(): string
    {
        return "NULL";
    }

    public function notnull(): string
    {
        return "NOT NULL";
    }

    public function default(mixed $value): string
    {
        return "DEFAULT $value";
    }

    public function unsigned(): string
    {
        return "UNSIGNED";
    }

    public function length(int $length): string
    {
        return "($length)";
    }

    public function value(string $value)
    {
        return "($value)";
    }
}
