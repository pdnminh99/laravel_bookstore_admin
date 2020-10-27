<div class="media align-items-center">
    @if(isset($thumbnail) && isset($route))
        <a href="{{ $route }}" class="avatar rounded-circle mr-3">
            <img alt="{{ $content }}" src="{{ asset($thumbnail) }}">
        </a>
    @elseif(isset($thumbnail))
        <span class="avatar rounded-circle mr-3">
            <img alt="{{ $content }}" src="{{ asset($thumbnail) }}">
        </span>
    @endif

    <div class="media-body">
        @isset($route)
            <span class="name mb-0 text-sm">
                <a href="{{ $route }}">{{ $content ?? '' }}</a>
            </span>
        @else
            <span class="name mb-0 text-sm">{{ $content ?? '' }}</span>
        @endisset
    </div>
</div>
