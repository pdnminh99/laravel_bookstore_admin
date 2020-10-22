<?php

namespace App\View\Models;

abstract class TabularField
{
    public string $type;

    public ?string $route;

    public function __construct(?string $route, string $type)
    {
        $this->route = $route;
        $this->type = $type;
    }

    public static function parse(string $content, ?string $thumbnail = null, ?string $status = null, ?string $route = null): TabularTextField
    {
        // TODO implement this.
    }

    public static function parse_text(string $content, ?string $route = null): TabularTextField
    {
        return new TabularTextField($content, $route, FieldType::TEXT);
    }

    public static function parse_text_w_thumbnail(string $content, ?string $thumbnail, ?string $route = null): TabularTextWThumbnailField
    {
        return new TabularTextWThumbnailField($content, $thumbnail, $route, FieldType::TEXT_W_THUMBNAIL);
    }

    public static function parse_status(string $content, string $status = 'success', ?string $route = null): TabularStatusField
    {
        return new TabularStatusField($content, $status, $route, FieldType::STATUS);
    }

    public static function new_actions_builder(?string $route = null): TabularActionsBuilder
    {
        return new TabularActionsBuilder($route);
    }
}
