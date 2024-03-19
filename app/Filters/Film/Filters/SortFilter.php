<?php

namespace App\Filters\Film\Filters;

use App\Filters\Filter;
use Database\QueryBuilder;

class SortFilter implements Filter
{
    private string|null $sort;

    public function __construct(string|null $sort)
    {
        $this->sort = $sort;
    }

    public function apply(QueryBuilder $queryBuilder): QueryBuilder
    {
        return match ($this->sort) {
            'order' => $queryBuilder->orderBy('title', 'ASC'),
            'older' => $queryBuilder->orderBy('release_date', 'asc'),
            default => $queryBuilder->orderBy('release_date', 'desc'),
        };
    }
}
