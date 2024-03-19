<?php

namespace Database;

use PDO;

class QueryBuilder
{
    private string $table;
    private array $conditions = [];
    private array $bindings = [];
    private string $orderBy = '';
    private string $limit = '';
    protected PDO $pdo;

    public function __construct(string $table)
    {
        $this->pdo = DB::getConnection();
        $this->table = $table;
    }

    public function limit(int $limit): self
    {
        $this->limit = "LIMIT {$limit}";
        return $this;
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->conditions[] = "{$column} {$operator} :{$column}";
        return $this;
    }

    public function whereRaw(string $condition, array $bindings = []): self
    {
        $this->conditions[] = $condition;
        $this->bindings = array_merge($this->bindings, $bindings);
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->orderBy = "ORDER BY {$column} {$direction}";
        return $this;
    }

    public function buildQuery(): string
    {
        $conditions = implode(' AND ', $this->conditions);

        $sql = "SELECT * FROM {$this->table}";
        if (!empty($this->conditions)) {
            $sql .= " WHERE {$conditions}";
        }
        if (!empty($this->orderBy)) {
            $sql .= " {$this->orderBy}";
        }

        return $sql;
    }

    public function get(): array
    {
        $sql = $this->buildQuery();
        $query = $this->pdo->prepare($sql);

        foreach ($this->bindings as $key => $value) {
            $query->bindValue($key, $value);
        }

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
