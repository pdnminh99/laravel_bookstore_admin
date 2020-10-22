<?php

namespace App\Models;

use App\View\Models\TabularField;
use App\View\Models\TabularRecord;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements TabularRecord
{
    public string $id;

    public string $title;

    public string $author;

    public string $publisher;

    public int $year_of_publishing;

    public int $pages;

    public int $in_stock;

    public static function new(string $title, string $author, string $publisher)
    {
        return new Book('1', $title, $author, $publisher, 2000, 100, 100);
    }

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

    public function get_fields()
    {
        return [
            TabularField::parse_text_w_thumbnail($this->title, 'img/theme/bootstrap.jpg', '#'),
            TabularField::parse_text($this->author),
            TabularField::parse_text($this->publisher),
            TabularField::parse_status('in stock'),
            TabularField::parse_text('999$'),
            TabularField::new_actions_builder('book')
                ->add_action('details', '')
                ->add_action('edit', '')
                ->add_action('delete', '')
                ->build()
        ];
    }

    public static function get_headers()
    {
        return ['title', 'author', 'publisher', 'status', 'price', ''];
    }
}
