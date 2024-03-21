<?php

namespace App\Repositories;

use App\Filters\Film\FilmFilterDTO;
use App\Filters\Film\Filters\SearchFilter;
use App\Filters\Film\Filters\SortFilter;
use App\Filters\FilterBuilder;
use App\Models\Film;
use Database\QueryBuilder;

class FilmRepository
{
    protected Film $model;

    public function __construct()
    {
        $this->model = new Film();
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
    
    public function filter(FilmFilterDTO $inputs): QueryBuilder
    {
        $queryBuilder = new QueryBuilder('films');

        $filterBuilder = new FilterBuilder();

        $filterBuilder->addFilter(new SearchFilter($inputs->search));
        $filterBuilder->addFilter(new SortFilter($inputs->sort));

        $filterBuilder->apply($queryBuilder);

        return $queryBuilder;
    }
}
