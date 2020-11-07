<?php

namespace App\Models;

use App\View\Models\TabularField;
use App\View\Models\TabularRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model implements TabularRecord
{
    use HasFactory;

    protected $casts = [
        'price' => 'integer',
        'count' => 'integer'
    ];

    public function get_fields()
    {
        $book_id = $this->book->id;
        $price = number_format($this->price);
        $total = number_format($this->total());

        return [
            TabularField::parse_text($book_id, null, "/books/$book_id"),
            TabularField::parse_text($this->book->title, null, "/books/$book_id"),
            TabularField::parse_text("$price$"),
            TabularField::parse_text("$this->count"),
            TabularField::parse_text("$total$"),
            TabularField::new_actions_builder('books')
                ->add_action('details', "/books/$book_id")
                ->add_action_w_modal_confirm('delete', "/orders/items/{$this->order->id}/$this->id")
                ->build()
        ];
    }

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function total()
    {
        return $this->price * $this->count;
    }

    public static function get_headers()
    {
        return ['id', 'title', 'price', 'count', 'total', ''];
    }
}
