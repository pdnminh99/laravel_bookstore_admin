<?php

namespace App\View\Models;

class TabularActionsBuilder
{
    private array $actions = [];

    private ?string $route;

    public function __construct(?string $route)
    {
        $this->route = $route;
    }

    public function add_action(string $name, string $route): TabularActionsBuilder
    {
        array_push($this->actions, ['name' => $name, 'route' => $route]);
        return $this;
    }

    public function build(): TabularActionsField
    {
        return new TabularActionsField($this->actions, $this->route, FieldType::ACTIONS);
    }
}
