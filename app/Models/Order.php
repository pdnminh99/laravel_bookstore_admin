<?php

namespace App\Models;

use App\View\Models\TabularField;
use App\View\Models\TabularRecord;
use Illuminate\Database\Eloquent\Model;

class Order extends Model implements TabularRecord
{
    public string $id;

    public User $customer;

    public array $items;

    public string $address;

    public string $phone_number;

    public string $note;

    public string $status;

    public function __construct(string $id, User $customer, string $address, array $items, string $phone_number, string $note, string $status)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->address = $address;
        $this->items = $items;
        $this->phone_number = $phone_number;
        $this->note = $note;
        $this->status = $status;
    }

    public function get_total_cost()
    {
        return array_reduce($this->items, function (int $price, Item $initial) {
            return $price + $initial->get_cost();
        });
    }

    public function get_total_items_count()
    {
        return array_reduce($this->items, function (int $accumulation, Item $initial) {
            return $accumulation + $initial->count;
        });
    }

    public function get_fields()
    {
        return [
            TabularField::parse_text($this->id),
            TabularField::parse_text('Mr.Bean'),
            TabularField::parse_text($this->get_total_items_count()),
            TabularField::parse_text($this->get_total_cost()),
            TabularField::parse_text($this->status),
            TabularField::new_actions_builder('order')
                ->add_action('details', '')
                ->add_action('edit', '')
                ->add_action_w_modal_confirm('delete', '', "Are you sure to delete $this->title")
                ->build()
        ];
    }

    public static function get_headers()
    {
        return ['orderId', 'customer', 'count', 'price', 'status', ''];
    }
}
