<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected User $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function create(array $data): ?array
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    public function findBy(string $column, mixed $value): ?array
    {
        return $this->model->findBy($column, $value);
    }

    public function all(): array
    {
        return $this->model->all();
    }
}
