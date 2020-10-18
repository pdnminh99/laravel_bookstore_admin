<?php

namespace App\View\Models;

class TabularTextWThumbnailField extends TabularTextField
{
    public string $thumbnail;

    public function __construct(string $content, string $thumbnail, ?string $route, string $type)
    {
        parent::__construct($content, $route, $type);
        $this->thumbnail = $thumbnail;
    }
}
