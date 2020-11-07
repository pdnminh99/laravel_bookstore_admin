<?php

namespace App\Models;

use App\View\Models\TabularField;
use App\View\Models\TabularRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements TabularRecord
{
    use HasFactory;

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

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function get_fields()
    {
        if ($this->in_stock > 40) $stock_status = StockStatus::IN_STOCK;
        else if ($this->in_stock > 10) $stock_status = StockStatus::ALMOST_OUT_OF_STOCK;
        else $stock_status = StockStatus::OUT_OF_STOCK;

        $price = number_format($this->price);

        return [
            TabularField::parse_text($this->id, null, "/books/$this->id"),
            TabularField::parse_text($this->title, null, "/books/$this->id"),
            TabularField::parse_text($this->author),
            TabularField::parse_text($this->category->name, null, "/categories/{$this->category->id}"),
            TabularField::parse_status($stock_status),
            TabularField::parse_text("$price$"),
            TabularField::new_actions_builder('books')
                ->add_action('details', "/books/$this->id")
                ->add_action_w_modal_confirm('delete', "/books/$this->id")
                ->build()
        ];
    }

    public static function get_headers()
    {
        return ['id', 'title', 'author', 'category', 'status', 'price', ''];
    }
}
