<?php

namespace App\Filters\Film\Filters;

use App\Filters\Filter;
use Database\QueryBuilder;

class SearchFilter implements Filter
{
    private string|null $search;

    public function __construct(string|null $search)
    {
        $this->search = $search;
    }

    public function apply(QueryBuilder $queryBuilder): QueryBuilder
    {
        if ($this->search) {
            $searchTerm = '%' . html_entity_decode($this->search) . '%';

            return $queryBuilder->whereRaw("title LIKE :search OR actors LIKE :search", [':search' => $searchTerm]);
        }

        return $queryBuilder;
    }
}