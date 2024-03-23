<?php

namespace Core;

use Database\DB;
use PDO;

abstract class Model
{
    protected PDO $pdo;
    protected string $table;
    protected array $attributes;

    public function __construct()
    {
        $this->pdo = DB::getConnection();
    }

    public function all(): array
    {
        $query = "SELECT * FROM {$this->table}";
        $statement = $this->pdo->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): ?array
    {
        $columns = implode(', ', $this->attributes);
        $params = array_map(fn($attr) => ":$attr", $this->attributes);
        $placeholders = implode(', ', $params);

        // Convert special characters to their actual representation
        $data = array_map(fn($value) => htmlspecialchars_decode($value), $data);

        $query = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $statement = $this->pdo->prepare($query);

        if ($statement->execute($data)) {
            // Fetch the created user by ID or any other unique identifier
            $userId = $this->pdo->lastInsertId();
            return $this->findBy('id', $userId); // Assuming you have a findById method in your repository
        }

        return null;
    }

    public function update(int $id, array $data): bool
    {
        $setValues = [];
        foreach ($data as $key => $value) {
            $setValues[] = "$key = ?";
        }

        $setClause = implode(', ', $setValues);
        $query = "UPDATE {$this->table} SET $setClause WHERE id = ?";
        $data['id'] = $id;

        $statement = $this->pdo->prepare($query);
        return $statement->execute(array_values($data));
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $statement = $this->pdo->prepare($query);
        return $statement->execute([$id]);
    }

    public function findBy(string $column, mixed $value): ?array
    {
        $query = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$value]);

        return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}