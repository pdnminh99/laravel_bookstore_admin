<?php

namespace App\Models;

use App\View\Models\TabularRecord;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TabularRecord
{
    protected $casts = [
        'name' => 'string'
    ];

//    public function books()
//    {
//
//    }

    public function get_fields()
    {
        // TODO: Implement get_fields() method.
    }

    public static function get_headers()
    {
        return ['id', 'name', ''];
    }
}
