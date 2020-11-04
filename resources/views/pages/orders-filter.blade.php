@extends('layouts.admin')

@section('header')
    @include('components.confirm-modal')
@endsection

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <x-breadcrumb
                        :routes='[["title" => "Order", "active" => false, "url" => "/orders?page=1"], ["title" => "Filter", "active" => true]]'></x-breadcrumb>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <x-card>
                    @slot('card_header')
                        table
                    @endslot

                    @slot('card_sub_header')
                        Orders filter settings
                    @endslot

                    @slot('card_body')
                        <form action="/orders/filter" method="POST">
                            @csrf
                            @method('POST')

                            @error('from')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('to')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('status')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('creation_date')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            <h6 class="heading-small text-muted mb-4">Filter by dates</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-from">From</label>
                                            <input class="form-control @error('from') is-invalid @enderror"
                                                   id="input-from"
                                                   max="{{ date('Y-m-d') }}"
                                                   min="{{ date('Y-m-d', 0) }}"
                                                   name="from"
                                                   placeholder="From?"
                                                   type="date"
                                                   value="{{ $filters['from'] }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-to">To</label>
                                            <input class="form-control @error('to') is-invalid @enderror"
                                                   id="input-to"
                                                   name="to"
                                                   placeholder="To?"
                                                   type="date"
                                                   min="{{ date('Y-m-d', 0) }}"
                                                   max="{{ date('Y-m-d') }}"
                                                   value="{{$filters['to']}}"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-status">Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                    id="input-status"
                                                    name="status"
                                            >
                                                <option value="NONE"
                                                    {{ $filters['status'] == 'NONE' ? 'selected' : '' }}>
                                                    None
                                                </option>
                                                <option value="{{ App\Models\OrderStatus::PENDING }}"
                                                    {{ $filters['status'] == App\Models\OrderStatus::PENDING ? 'selected' : '' }}>
                                                    {{ App\Models\OrderStatus::PENDING }}
                                                </option>
                                                <option value="{{ App\Models\OrderStatus::DELIVERING }}"
                                                    {{ $filters['status'] == App\Models\OrderStatus::DELIVERING ? 'selected' : '' }}>
                                                    {{ App\Models\OrderStatus::DELIVERING }}
                                                </option>
                                                <option value="{{ App\Models\OrderStatus::DELIVERED }}"
                                                    {{ $filters['status'] == App\Models\OrderStatus::DELIVERED ? 'selected' : '' }}>
                                                    {{ App\Models\OrderStatus::DELIVERED }}</option>
                                                <option value="{{ App\Models\OrderStatus::CANCELLED }}"
                                                    {{ $filters['status'] == App\Models\OrderStatus::CANCELLED ? 'selected' : '' }}>
                                                    {{ App\Models\OrderStatus::CANCELLED }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-creation-date">By creation
                                                date</label>
                                            <select class="form-control @error('creation_date') is-invalid @enderror"
                                                    id="input-creation-date"
                                                    name="creation_date"
                                            >
                                                <option value="ASC"
                                                    {{ $filters['creation_date'] == 'ASC' ? 'selected' : '' }}>
                                                    Ascending
                                                </option>
                                                <option value="DESC"
                                                    {{ $filters['creation_date'] == 'DESC' ? 'selected' : '' }}>
                                                    Descending
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-left">
                                    <button class="btn btn-primary mt-4"
                                            id="submit-filter"
                                            type="submit">
                                        Apply filter
                                    </button>

                                    <button class="btn btn-secondary mt-4"
                                            id="reset-btn"
                                            onclick="resetDefault()"
                                            type="button">
                                        Reset default
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endslot
                </x-card>
            </div>
        </div>
    </div>

    <script>
        const currentSettings = @json($filters, JSON_PRETTY_PRINT);
        const from = document.getElementById('input-from');
        const to = document.getElementById('input-to');
        const status = document.getElementById('input-status');
        const creationDate = document.getElementById('input-creation-date');
        const resetButton = document.getElementById('reset-btn');
        const submitButton = document.getElementById('submit-filter');

        onChange()

        function onChange() {
            let shouldDisable = true
            shouldDisable &&= from.value === '{{ date('Y-m-d', 0) }}'
            shouldDisable &&= to.value === '{{ date('Y-m-d') }}'
            shouldDisable &&= status.value === 'NONE'
            shouldDisable &&= creationDate.value === 'ASC'
            resetButton.disabled = shouldDisable

            shouldDisable = true
            shouldDisable &&= from.value === currentSettings.from
            shouldDisable &&= to.value === currentSettings.to
            shouldDisable &&= status.value === currentSettings.status
            shouldDisable &&= creationDate.value === currentSettings.creation_date
            submitButton.disabled = shouldDisable
        }

        from.addEventListener('change', onChange)
        to.addEventListener('change', onChange)
        status.addEventListener('change', onChange)
        creationDate.addEventListener('change', onChange)

        function resetDefault() {
            from.value = '{{ date('Y-m-d', 0) }}'
            to.value = '{{ date('Y-m-d') }}'
            status.value = 'NONE'
            creationDate.value = 'ASC'
            onChange()
        }
    </script>

@endsection
