<?php

namespace App\Models;

abstract class OrderStatus
{
    const PENDING = 'Pending';

    const DELIVERING = 'Delivering';

    const DELIVERED = 'Delivered';

    const CANCELLED = 'Cancelled';
}
