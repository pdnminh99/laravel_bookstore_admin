<?php

namespace App\View\Components;

use App\View\Models\PaginatorControl;
use Illuminate\View\Component;

class Paginator extends Component
{
    public int $current;

    public int $count;

    public string $route;

    public function __construct(int $current, int $count, string $route)
    {
        $this->current = $current;
        $this->count = $count;
        $this->route = $route;
    }

    public function is_prev_available(): bool
    {
        return $this->current > 1;
    }

    public function is_next_available(): bool
    {
        return $this->current < $this->count;
    }

    public function generate_pages(): array
    {
        $count = $this->count;
        $current = $this->current;
        $route = $this->route;
        $pages = [];

//        if ($count < 7) {
        for ($p = 1; $p <= $count; $p++)
            array_push($pages, [
                'number' => $p,
                'route' => "$route/$p",
                'active' => $p === $current
            ]);
//        } else {
//            for ($p = 1; $p <= 5; $p++)
//                array_push($pages, [
//                    'number' => $p,
//                    'route' => "$route/$p",
//                    'active' => $p === $current
//                ]);
//            array_push($pages, null);
//            array_push($pages, [
//                'number' => $p,
//                'route' => "$route/$p",
//                'active' => $p === $current
//            ]);
//        }
        return $pages;
    }

    public function render()
    {
        return view('components.paginator');
    }
}
