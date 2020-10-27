<?php

namespace App\Models;

abstract class StockStatus
{
    const OUT_OF_STOCK = 'Out of Stock';

    const ALMOST_OUT_OF_STOCK = 'Almost Out of Stock';

    const IN_STOCK = 'In Stock';
}
