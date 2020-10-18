<?php

namespace App\View\Components;

use App\View\Models\TabularRecord;
use Illuminate\View\Component;

class Table extends Component
{
    public array $headers;

    public array $records;

    public function __construct(array $headers, array $records)
    {
        // Input assertion
        foreach ($headers as $header) {
            if (is_string($header)) continue;
            throw new \Error("Invalid value passed into table.");
        }
        foreach ($records as $record) {
            if ($record instanceof TabularRecord) continue;
            throw new \Error("Invalid value passed into table.");
        }
        $this->headers = $headers;
        $this->records = $records;
    }

    public function render()
    {
        return view('containers.table');
    }
}
