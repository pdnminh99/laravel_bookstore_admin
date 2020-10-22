<?php

namespace App\View\Models;

interface TabularRecord
{
    public function get_fields();

    public static function get_headers();
}
