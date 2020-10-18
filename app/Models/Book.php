<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public string $id;

    public string $title;

    public string $author;

    public string $publisher;

    public int $year_of_publishing;

    public int $pages;

    public int $in_stock;

    public function __construct(
        string $id,
        string $title,
        string $author,
        string $publisher,
        int $year_of_publishing, int $pages,
        int $in_stock)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->year_of_publishing = $year_of_publishing;
        $this->pages = $pages;
        $this->in_stock = $in_stock;
    }

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
