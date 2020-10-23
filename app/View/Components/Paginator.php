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

        $first_num = $pages_numbers[0];
        if ($first_num == 2) array_unshift($pages_numbers, 1);
        else if ($first_num > 2) {
            array_unshift($pages_numbers, null);
            array_unshift($pages_numbers, 1);
        }

        $len = count($pages_numbers);
        $last_num = $pages_numbers[$len - 1];
        if ($last_num == $count - 1) array_push($pages_numbers, $count);
        else if ($last_num < $count - 1) {
            array_push($pages_numbers, null);
            array_push($pages_numbers, $count);
        }

        return array_map(function (?int $page_num) use ($current, $route) {
            if (is_null($page_num)) return null;
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
