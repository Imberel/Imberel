<?php

namespace Imberel\Imberel\Core\Database\Migration;

use Imberel\Imberel\Core\Extra\ICatch;
use Imberel\Imberel\Core\Extra\Random;
use Imberel\Imberel\Core\Connection\Connection;
use Imberel\Imberel\Core\Dotenv\Dotenv;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Migration extends Connection
{
    protected array $new = [];

    protected string $folderName = "/database/migrations/";

    protected Random $random;

    public function __construct()
    {
        new Dotenv(ROOTDIR . '/.env');
        parent::__construct();
        $this->random = new Random;
        try {
            $this->table();
            $this->setupDir();
        } catch (\Throwable $th) {
            new ICatch($th, "Migration");
        }
    }

    private function table(): void
    {
        $statement = "CREATE TABLE IF NOT EXISTS `migrations` (
                    `id` int(250) PRIMARY KEY AUTO_INCREMENT,
                    `migration` VARCHAR(250) NOT NULL,
                    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
        $this->pdo->exec($statement);
        return;
    }

    final public function create()
    {
        $template = \file_get_contents(\dirname(__DIR__) . "/Template/Migration.tpl");
        $migrationName = $this->random->string(5) . "_" . \date("Y_m_d") . "_" . $this->random->string(10) . ".php";
        \fopen(ROOTDIR . $this->folderName . $migrationName, "w");
        $filename = ROOTDIR . $this->folderName . $migrationName;
        $template = \str_replace("{{class}}", \pathinfo($migrationName, \PATHINFO_FILENAME), $template);
        \file_put_contents($filename, $template);
        $this->log("Migration " . \pathinfo($migrationName, \PATHINFO_FILENAME) . " Created Successfully");
        return;
    }

    private function truncate(): void
    {
        $statement = "TRUNCATE `migrations`";
        $this->pdo->exec($statement);
        $this->log("All migrations reversed successfully");
        return;
    }

    private function applied()
    {
        $stmt = $this->pdo->prepare("SELECT migration FROM migrations");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    private function migrated(): bool
    {
        $stmt = $this->pdo->prepare("SELECT migration FROM migrations");
        $stmt->execute();
        if ($stmt->rowCount() < 1) {
            return true;
        }

        return false;
    }

    private function migrateUp(): void
    {
        $migrations = \scandir(ROOTDIR . $this->folderName);
        $appliedMigrations = '';
        foreach ($this->applied() as $applied) {
            $appliedMigrations .= $applied . '.php,';
        }
        $to = \array_diff($migrations, \explode(',', $appliedMigrations));
        foreach ($to as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require_once ROOTDIR . $this->folderName . $migration;
            $class = \pathinfo($migration, \PATHINFO_FILENAME);
            $instance = new $class;
            $this->log($class . " Applying.....");
            $instance->up();
            $this->log($class . " Applied Successfully");
            $this->new[] = $migration;
        }
        return;
    }

    private function migrateDown(): void
    {
        $migrations = \scandir(ROOTDIR . $this->folderName);
        foreach ($migrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require_once ROOTDIR . $this->folderName . $migration;
            $class = \pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $class;
            $this->log($class . " reversing .....");
            $instance->down();
            $this->log($class . ' reversed successfully');
        }
        return;
    }

    private function beforeReverse(): void
    {
        if ($this->migrated()) {
            $this->log("No Migrations applied Yet");
            exit;
        }
        return;
    }

    private function check(): void
    {
        if (empty($this->new)) {
            $this->log("Migrations already applied");
            return;
        }

        $this->run($this->new);
        return;
    }

    private function run(array $migrations): void
    {
        foreach ($migrations as $migration) {
            $migration = \pathinfo($migration, PATHINFO_FILENAME);
            $stmt = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
            $stmt->bindValue(":migration", $migration);
            $stmt->execute();
        }
        return;
    }

    final public function migrate(): void
    {
        $this->migrateUp();
        $this->check();
        return;
    }

    final public function fresh(): void
    {
        $this->beforeReverse();
        $this->migrateDown();
        $this->truncate();
        $this->migrate();
        return;
    }

    final public function reverse(): void
    {
        $this->beforeReverse();
        $this->MigrateDown();
        $this->truncate();
        return;
    }

    private function log(string $log): void
    {
        print "[" . \date("h:m:s D d-M-Y") . "] - " . \ucwords($log) . PHP_EOL;
        return;
    }

    private function setupDir(): void
    {
        if (\file_exists(ROOTDIR . $this->folderName)) {
            return;
        }

        \mkdir(ROOTDIR . $this->folderName, 0777);
        return;
    }
}