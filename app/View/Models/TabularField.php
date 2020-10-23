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

    public static function parse_text(string $content, ?string $thumbnail = null, ?string $route = null): TabularTextField
    {
        return new TabularTextField($content, $thumbnail, $route);
    }

    public static function parse_status(string $content, string $status = 'success', ?string $route = null): TabularStatusField
    {
        return new TabularStatusField($content, $status, $route);
    }

    public static function new_actions_builder(?string $route = null): TabularActionsBuilder
    {
        return new TabularActionsBuilder($route);
    }
}
