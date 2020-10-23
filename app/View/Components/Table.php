<?php

namespace App\View\Components;

use App\View\Models\TabularRecord;
use Illuminate\View\Component;

class Table extends Component
{
    public array $headers;

    public array $records;

    public function __construct(array $records)
    {
        foreach ($records as $record) {
            if ($record instanceof TabularRecord) continue;
            throw new \Error("Invalid value passed into table.");
        }
        $is_exist = count($records) > 0;
        $this->headers = $is_exist ? get_class($records[0])::get_headers() : [];
        $this->records = $records;
    }

    public function render()
    {
        return view('containers.table');
    }
}
