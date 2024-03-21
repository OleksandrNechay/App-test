<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected string $table = 'users';
    protected array $attributes = ['name', 'email', 'password'];

    protected array $casts = [
        'password' => 'hash',
    ];

    public function create(array $data): ?array
    {
        foreach ($this->casts as $field => $action) {
            switch ($action) {
                case 'hash':
                    $data[$field] = password_hash($data[$field], PASSWORD_DEFAULT);
                    break;
                default:
                    // Handle other casting actions if needed in the future
                    break;
            }
        }

        return parent::create($data);
    }


}