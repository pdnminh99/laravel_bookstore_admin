<li class="nav-item">
    <a class="nav-link{{  Illuminate\Support\Facades\Request::is($nav['url']) ? ' active' : '' }}"
       href="/{{ $nav['url'] }}">
        <i class="ni {{ $nav['icon'] }}"></i>
        <span class="nav-link-text">{{ $nav['text'] }}</span>
    </a>
</li>
