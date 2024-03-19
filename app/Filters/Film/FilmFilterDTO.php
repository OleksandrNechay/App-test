<?php

namespace App\Filters\Film;

use Core\Request;

class FilmFilterDTO
{
    public null|string $search  = null;
    public string $sort = 'new';

    public function __construct(Request $request)
    {
        $this->init($request);
    }

    public static function make(Request $request)
    {
        return new self($request);
    }

    private function init(Request $request): void
    {
        $this->setSearch($request->getOption('q'));
        $this->setSort($request->getOption('sort'));

    }

    private function setSearch(string|null $search): void
    {
        $this->search = $search;
    }

    private function setSort(string|null $sort): void
    {
        if(!$sort) return;
        $this->sort = $sort;

    }
}