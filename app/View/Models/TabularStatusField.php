<?php

namespace App\View\Models;

class TabularStatusField extends TabularTextField
{
    public string $status;

    public function __construct(string $content, string $status, ?string $route = null)
    {
        parent::__construct($content, $route, FieldType::STATUS);
        $this->status = $status;
    }
}
