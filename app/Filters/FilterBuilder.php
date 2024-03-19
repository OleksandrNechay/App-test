<?php

namespace App\Filters;

use Database\QueryBuilder;

class FilterBuilder
{
    private array $filters = [];

    public function addFilter(Filter $filter): void
    {
        $this->filters[] = $filter;
    }

    public function apply(QueryBuilder $builder): void
    {
        foreach ($this->filters as $filter) {
            $filter->apply($builder);
        }
    }
}
