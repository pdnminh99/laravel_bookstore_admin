<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TabularStatus extends Component
{
    public string $message;

    public string $status;

    public function __construct(string $message, string $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    public function render()
    {
        return view('components.tabular.status');
    }
}
