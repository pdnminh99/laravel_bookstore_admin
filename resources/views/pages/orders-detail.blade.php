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
                        :routes='[["title" => "Order", "active" => false, "url" => "/orders?page=1"], ["title" => "$order->id", "active" => false]]'></x-breadcrumb>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <x-card>
                    @slot('card_header')
                        Order id {{ $order->id }}
                    @endslot

                    @slot('card_sub_header')
                        This table is for admins only
                    @endslot

                    <x-table :records="$items"></x-table>

                    @if($pages > 1)
                        @slot('card_footer')
                            <x-paginator :current="$page_number" :count="$pages" route="/orders"></x-paginator>
                        @endslot
                    @endif

                    @slot('card_body')
                        <form action="/orders/{{ $order->id }}" method="POST">
                            @csrf
                            @method('PATCH')

                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @error('customer_name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('customer_address')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('customer_phone')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('customer_country')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('customer_city')
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

                            <h6 class="heading-small text-muted mb-4">Basic information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                           id="input-title"
                                           name="name"
                                           placeholder="Name"
                                           type="text"
                                           value="{{ $order->customer_name ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="input-description" class="form-control-label">Address</label>
                                    <textarea id="input-description"
                                              rows="4"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description"
                                              placeholder="A few words about the category ..."
                                    >{{ $category->customer_address ?? '' }}</textarea>
                                </div>

                                <div class="text-left">
                                    <button type="submit"
                                            class="btn btn-primary mt-4"
                                    >
                                        Save changes
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
        const numInputs = document.querySelectorAll('input[type=number]')

        numInputs.forEach(function (input) {
            input.addEventListener('change', function (e) {
                if (e.target.value === '') e.target.value = 0
            })
        })
    </script>

@endsection
