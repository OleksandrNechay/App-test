<?php

namespace Core\Migrations;

use PDO;

class create_table_films_17032024
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function up(): void
    {
        $query = "
            CREATE TABLE IF NOT EXISTS films (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                format VARCHAR(50) NOT NULL,
                release_date DATE,
                 actors TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";

        $this->pdo->exec($query);
    }

    public function down(): void
    {
        $query = "DROP TABLE IF EXISTS films";
        $this->pdo->exec($query);
    }
}
