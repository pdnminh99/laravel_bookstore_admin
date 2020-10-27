<div class="dropdown">
    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        @foreach($actions as $action)
            @if(!isset($action['modal_message']))
                <a class="dropdown-item"
                   href="{{ $action['route'] ?? 'javascript:void(0)' }}"
                >{{ $action['name'] ?? '' }}</a>
            @else
                <button class="dropdown-item"
                        data-toggle="modal"
                        data-target="#confirm-modal"
                        onclick="registerConfirmRoute('{{ $action['route'] }}', 'books?page=1', 'DELETE')"
                >
                    {{ $action['name'] ?? '' }}
                </button>
            @endif
        @endforeach

    </div>
</div>
