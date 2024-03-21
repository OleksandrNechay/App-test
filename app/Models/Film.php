<?php

namespace App\Models;

use Core\Model;

class Film extends Model
{
    protected string $table = 'films';
    protected array $attributes = ['title', 'format', 'release_date', 'actors'];
}