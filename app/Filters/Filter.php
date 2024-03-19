<?php


namespace App\Filters;

use Database\QueryBuilder;

interface Filter
{
    public function apply(QueryBuilder $queryBuilder);
}
