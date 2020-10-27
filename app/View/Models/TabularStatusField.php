<?php

namespace App\View\Models;

class TabularStatusField extends TabularField
{
    public string $content;

    public string $status;

    public function __construct(string $content, string $status, ?string $route = null)
    {
        parent::__construct($route, FieldType::STATUS);
        $this->content = $content;
        $this->status = $status;
    }
}
