<?php

namespace App\View\Models;

class TabularStatusField extends TabularTextField
{
    public string $status;

    public function __construct(string $content, string $status, ?string $route, string $type)
    {
        parent::__construct($content, $route, $type);
        $this->status = $status;
    }
}
