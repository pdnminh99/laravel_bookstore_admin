<?php

namespace App\View\Models;

class TabularTextField extends TabularField
{
    public string $content;

    public ?string $thumbnail;

    public function __construct(string $content, ?string $thumbnail = null, ?string $route = null)
    {
        parent::__construct($route, FieldType::TEXT);
        $this->content = $content;
        $this->thumbnail = $thumbnail;
    }
}
