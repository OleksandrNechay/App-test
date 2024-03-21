<?php

namespace Database;

use PDO;
use PDOException;

class Migration
{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=".DB_HOST.";port=3399;dbname=".DB_NAME,DB_USER, DB_PASSWORD);
    }

    public function run(): void
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $files = scandir(__DIR__ . "/migrations");
        $newMigrations = array_diff($files, $appliedMigrations);

        foreach ($newMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once __DIR__.'/migrations/'.$migration;
            $className = "\Database\Migrations\\" . pathinfo($migration, PATHINFO_FILENAME);

            $instance = new $className($this->pdo);
            $instance->up();

            // Add the migration to the migrations table
            $this->saveMigration($migration);
        }
    }

    private function saveMigration(string $migration): void
    {
        $query = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
        $query->bindParam(':migration', $migration);
        $query->execute();
    }

    public function createMigrationsTable(): void
    {
        try {
            $query = "
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ";

            // Execute the SQL query to create the table
            $this->pdo->exec($query);
        } catch (PDOException $e) {
            echo "Error creating migrations table: " . $e->getMessage();
        }
    }

    public function getAppliedMigrations(): false|array
    {
        $query = $this->pdo->prepare("SELECT migration FROM migrations");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN);
    }
}