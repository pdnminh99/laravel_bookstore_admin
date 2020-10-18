<nav aria-label="...">
    <ul class="pagination justify-content-end mb-0">
        <li class="page-item{{ $is_prev_available() ? '' : ' disabled' }}">
            @if($is_prev_available())
                <a class="page-link" href="#" tabindex="-1">
                    <i class="fas fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
            @else
                <a class="page-link" href="javascript:void(0)">
                    <i class="fas fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
            @endif
        </li>

        @foreach($generate_pages() as $page)
            @if(is_null($page))
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)">...</a>
                </li>
            @elseif($page['active'])
                <li class="page-item active">
                    <a class="page-link" href="{{ $page['route'] }}">
                        {{ $page['number'] }}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)">
                        {{ $page['number'] }}
                    </a>
                </li>
            @endif
        @endforeach

        <li class="page-item{{ $is_next_available() ? '' : ' disabled' }}">
            @if($is_next_available())
                <a class="page-link" href="#">
                    <i class="fas fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                </a>
            @else
                <a class="page-link" href="javascript:void(0)">
                    <i class="fas fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                </a>
            @endif
        </li>
    </ul>
</nav>
