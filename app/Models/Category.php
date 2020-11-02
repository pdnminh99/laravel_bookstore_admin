<?php

namespace App\Models;

use App\View\Models\TabularField;
use App\View\Models\TabularRecord;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TabularRecord
{
    protected $casts = [
        'name' => 'string',
        'description' => 'string'
    ];

//    public function books()
//    {
//
//    }

    public function get_fields()
    {
        return [
            TabularField::parse_text($this->id, null, "categories/$this->id"),
            TabularField::parse_text($this->name, null, "categories/$this->id"),
            TabularField::parse_text("0"),
            TabularField::parse_text(substr($this->description ?? '', 0, 50)),
            TabularField::new_actions_builder('categories')
                ->add_action('details', "categories/$this->id")
                ->add_action_w_modal_confirm('delete', "categories/$this->id")
                ->build()
        ];
    }

    public static function get_headers()
    {
        return ['id', 'name', 'items count', 'description', ''];
    }
}
