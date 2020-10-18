@if(isset($actions) && count($actions) > 0)
    <div class="dropdown">
        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            @foreach($actions as $action)
                <a class="dropdown-item" href="{{ $action['route'] }}">{{ $action['name'] }}</a>
            @endforeach
        </div>
    </div>
@endif
