<?php

namespace App\View\Models;

class TabularTextField extends TabularField
{
    public string $content;

    public function __construct(string $content, ?string $route, string $type)
    {
        parent::__construct($route, $type);
        $this->content = $content;
    }
}
