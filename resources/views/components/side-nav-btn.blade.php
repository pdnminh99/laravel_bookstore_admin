<li class="nav-item">
    <a class="nav-link{{ $nav['active'] ? ' active' : '' }}" href="{{ $nav['url'] }}">
        <i class="ni {{ $nav['icon'] }}"></i>
        <span class="nav-link-text">{{ $nav['text'] }}</span>
    </a>
</li>
