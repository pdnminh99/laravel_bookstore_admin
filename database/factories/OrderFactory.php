<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $status_rnd = [
            OrderStatus::PENDING,
            OrderStatus::CANCELLED,
            OrderStatus::DELIVERED,
            OrderStatus::DELIVERING
        ];

        return [
            'customer_name' => Str::random(10),
            'customer_phone' => Str::random(10),
            'customer_address' => Str::random(10),
            'customer_country' => Str::random(10),
            'customer_city' => Str::random(10),
            'status' => $status_rnd[rand(0, count($status_rnd) - 1)],
            'note' => Str::random(100),
            'customer_id' => rand(1, 3),
            'staff_id' => rand(1, 3)
        ];
    }
}
