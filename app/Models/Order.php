<?php

namespace App\Models;

use App\View\Models\TabularField;
use App\View\Models\TabularRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model implements TabularRecord
{
    use HasFactory;

    protected $casts = [
        'customer_name' => 'string',
        'customer_phone' => 'string',
        'customer_address' => 'string',
        'customer_email' => 'string',
        'customer_country' => 'string',
        'customer_city' => 'string',
        'note' => 'string',
        'status' => 'string'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\User', 'staff_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function total_bill(): int
    {
        $total = 0;

        foreach ($this->items()->get() as $item) {
            $total += $item->total();
        }
        return $total;
    }

    public function get_fields()
    {
        $total_bill = number_format($this->total_bill());

        return [
            TabularField::parse_text($this->id, null, "/orders/$this->id"),
            TabularField::parse_text($this->customer_name),
            TabularField::parse_text($this->customer_email),
            TabularField::parse_text($this->status),
            TabularField::parse_text("$total_bill$"),
            TabularField::new_actions_builder('orders')
                ->add_action('details', "/orders/$this->id")
                ->build()
        ];
    }

    public static function get_headers()
    {
        return ['id', 'customer', 'email', 'status', 'total bills', ''];
    }
}
