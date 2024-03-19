<?php

namespace Core;

use Database\DB;
use PDO;

abstract class Model
{
    protected PDO $pdo;
    protected string $table;

    public function __construct()
    {
        $this->pdo = DB::getConnection();
    }

    public function all(): array
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $query = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute(array_values($data));
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

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(array_values($data));
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$id]);
    }

    public function findById(int $id): ?array
    {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}