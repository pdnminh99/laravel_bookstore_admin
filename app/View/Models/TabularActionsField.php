<?php

namespace App\View\Models;

class TabularActionsField extends TabularField
{
    public array $actions;

    public function __construct(array $actions, ?string $route, string $type)
    {
        parent::__construct($route, $type);
        $this->actions = $actions;
    }
}

