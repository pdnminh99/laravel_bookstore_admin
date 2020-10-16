<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "title",
        "author",
        "description",
        "price"
    ];

    protected $casts = [
        "title" => "string",
        "author" => "string",
        "description" => "string",
        "price" => "integer"
    ];

    const CREATED_AT = 'creation_date';

    const UPDATED_AT = 'last_update';
}
