<div class="card">
    @isset($card_header)
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">
                        {{ $card_header }}
                    </h6>

                    @isset($card_sub_header)
                        <h5 class="h3 mb-0">{{ $card_sub_header }}</h5>
                    @endisset
                </div>
            </div>
        </div>
    @endisset

    @isset($card_body)
        <div class="card-body">
            {{ $card_body }}
        </div>
    @endisset

    @isset($slot)
        {{ $slot }}
    @endisset

    @isset($card_footer)
        <div class="card-footer py-4">
            {{ $card_footer }}
        </div>
    @endisset
</div>
