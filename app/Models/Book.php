<?php

namespace App\Models;

use App\View\Models\TabularField;
use App\View\Models\TabularRecord;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements TabularRecord
{
    protected $casts = [
        'title' => 'string',
        'author' => 'string',
        'publisher' => 'string',
        'description' => 'string',
        'price' => 'integer',
        'in_stock' => 'integer',
        'pages' => 'integer',
        'year_of_publishing' => 'integer'
    ];

    public function get_fields()
    {
        if ($this->in_stock > 40) $stock_status = 'in stock';
        else if ($this->in_stock > 10) $stock_status = 'almost out of stock';
        else $stock_status = 'out of stock';

        return [
            TabularField::parse_text($this->title),
            TabularField::parse_text($this->author),
            TabularField::parse_text($this->publisher),
            TabularField::parse_status($stock_status),
            TabularField::parse_text($this->price),
            TabularField::new_actions_builder('books')
                ->add_action('details', '')
                ->add_action('edit', '')
                ->add_action_w_modal_confirm('delete', "books/$this->book_id")
                ->build()
        ];
    }

    public static function get_headers()
    {
        return ['title', 'author', 'publisher', 'status', 'price', ''];
    }
}
