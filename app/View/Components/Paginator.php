<?php

namespace App\View\Components;

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
        $pages_numbers = [];

        $cursor = $current - 3;
        while (count($pages_numbers) < 7 && $cursor <= $count) {
            if ($cursor > 0) array_push($pages_numbers, $cursor);
            $cursor++;
        }

        $cursor = $pages_numbers[0] - 1;
        while (count($pages_numbers) < 7 && $cursor > 0) {
            array_unshift($pages_numbers, $cursor);
            $cursor--;
        }

        return array_map(function (?int $page_num) use ($current, $route) {
            return [
                'number' => $page_num,
                'route' => "$route?page=$page_num",
                'active' => $page_num === $current
            ];
        }, $pages_numbers);
    }

    public function render()
    {
        return view('components.paginator');
    }
}
