<?php

namespace App\Models;

use App\View\Models\TabularField;
use App\View\Models\TabularRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model implements TabularRecord
{
    use HasFactory;

    protected $casts = [
        'customer_name' => 'string',
        'customer_phone' => 'string',
        'customer_address' => 'string',
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

        $user_can_view_customer_profile = Auth::user()->can('view profiles') || $this->customer->id == Auth::user()->id;

        return [
            TabularField::parse_text($this->id, null, "/orders/$this->id"),
            TabularField::parse_text($this->customer_name, null, $user_can_view_customer_profile ? "/users/{$this->customer->id}" : null),
            TabularField::parse_text($this->customer->email, null, $user_can_view_customer_profile ? "/users/{$this->customer->id}" : null),
            TabularField::parse_status($this->status),
            TabularField::parse_text($this->created_at),
            TabularField::parse_text("$total_bill$"),
            TabularField::new_actions_builder('orders')
                ->add_action('details', "/orders/$this->id")
                ->add_action_w_modal_confirm('delete', "/orders/$this->id")
                ->build()
        ];
    }

    public static function get_headers()
    {
        return ['id', 'customer', 'email', 'status', 'creation date', 'total bills', ''];
    }
}
