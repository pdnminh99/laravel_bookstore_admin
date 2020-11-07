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
        $this->records = $records;
        $this->headers = $this->is_exist() ? get_class($records[0])::get_headers() : [];
    }

    public function is_exist()
    {
        return isset($this->records) && count($this->records) > 0;
    }

    public function render()
    {
        return view('containers.table');
    }
}
