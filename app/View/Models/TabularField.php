<?php

namespace App\View\Models;

use App\Models\StockStatus;

abstract class TabularField
{
    public string $type;

    public ?string $route;

    public function __construct(?string $route, string $type)
    {
        $this->route = $route;
        $this->type = $type;
    }

    public static function parse_text(string $content, ?string $thumbnail = null, ?string $route = null): TabularTextField
    {
        return new TabularTextField($content, $thumbnail, $route);
    }

    public static function parse_status(string $status = StockStatus::IN_STOCK, ?string $route = null): TabularStatusField
    {
        switch ($status) {
            case StockStatus::OUT_OF_STOCK:
                $icon = 'danger';
                break;
            case StockStatus::IN_STOCK:
            case StockStatus::ALMOST_OUT_OF_STOCK:
            default:
                $icon = 'success';
                break;
        }
        return new TabularStatusField($status, $icon, $route);
    }

    public static function new_actions_builder(?string $route = null): TabularActionsBuilder
    {
        return new TabularActionsBuilder($route);
    }
}
