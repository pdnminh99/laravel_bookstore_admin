<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public ?array $card_action;

    public function __construct(?array $card_action = null)
    {
        $this->card_action = $card_action;
    }

    public function render()
    {
        return view('components.card');
    }
}
