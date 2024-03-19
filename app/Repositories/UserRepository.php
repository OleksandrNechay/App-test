<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected User $model;

    public function __construct()
    {
        $this->user = new User();
    }

    public function create(array $data): bool
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

    public function findById(int $id): ?array
    {
        return $this->model->findById($id);
    }

    public function all(): array
    {
        return $this->model->all();
    }
}
