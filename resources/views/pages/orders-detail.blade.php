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
                        Order details
                    @endslot

                    @slot('card_sub_header')
                        ID: {{ $order->id }}
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

                            <h6 class="heading-small text-muted mb-4">Customer info
                                @can('view profiles')
                                    | <a href="/users/{{ $order->customer->id }}">View details</a>
                                @endcan
                            </h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-customer-name">Customer
                                                name</label>
                                            <input class="form-control @error('customer_name') is-invalid @enderror"
                                                   id="input-customer-name"
                                                   name="customer_name"
                                                   placeholder="Name"
                                                   type="text"
                                                   value="{{ $order->customer_name ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-description" class="form-control-label">Phone
                                                number</label>
                                            <input id="input-description"
                                                   type="tel"
                                                   class="form-control @error('customer_phone') is-invalid @enderror"
                                                   name="customer_phone"
                                                   placeholder="Phone number"
                                                   value="{{ $order->customer_phone ?? '' }}"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-customer_address">Home
                                                Address</label>
                                            <input class="form-control @error('customer_address') is-invalid @enderror"
                                                   id="input-customer_address"
                                                   name="customer_address"
                                                   placeholder="Home Address"
                                                   type="text"
                                                   value="{{ $order->customer_address ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-customer_email" class="form-control-label">Email</label>
                                            <input id="input-customer_email"
                                                   type="email"
                                                   class="form-control"
                                                   disabled
                                                   value="{{ $order->customer->email ?? '' }}"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="input-customer-country">Country</label>
                                            <input class="form-control @error('customer_country') is-invalid @enderror"
                                                   id="input-customer-country"
                                                   name="customer_country"
                                                   placeholder="Country"
                                                   type="text"
                                                   value="{{ $order->customer_country ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-customer-city" class="form-control-label">City</label>
                                            <input id="input-customer-city"
                                                   type="text"
                                                   class="form-control @error('customer_city') is-invalid @enderror"
                                                   name="customer_city"
                                                   placeholder="City"
                                                   value="{{ $order->customer_city ?? '' }}"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-created-at" class="form-control-label">
                                                Created timestamp
                                            </label>
                                            <input id="input-created-at"
                                                   type="text"
                                                   disabled
                                                   class="form-control"
                                                   value="{{ $order->created_at ?? '' }}"
                                            />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-updated-at" class="form-control-label">
                                                Last edited timestamp
                                            </label>
                                            <input id="input-updated-at"
                                                   type="text"
                                                   disabled
                                                   class="form-control"
                                                   value="{{ $order->updated_at ?? '' }}"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br/>

                            <h6 class="heading-small text-muted mb-4">Items info</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-status">
                                                Status
                                            </label>
                                            <select class="form-control"
                                                    id="input-status"
                                                    name="status"
                                            >
                                                <option value="{{ \App\Models\OrderStatus::PENDING }}"
                                                    {{ $order->status == \App\Models\OrderStatus::PENDING ? 'selected' : '' }}
                                                >
                                                    {{ \App\Models\OrderStatus::PENDING }}
                                                </option>

                                                <option value="{{ \App\Models\OrderStatus::DELIVERING }}"
                                                    {{ $order->status == \App\Models\OrderStatus::DELIVERING ? 'selected' : '' }}
                                                >
                                                    {{ \App\Models\OrderStatus::DELIVERING }}
                                                </option>

                                                <option value="{{ \App\Models\OrderStatus::DELIVERED }}"
                                                    {{ $order->status == \App\Models\OrderStatus::DELIVERED ? 'selected' : '' }}
                                                >{{ \App\Models\OrderStatus::DELIVERED }}</option>

                                                <option value="{{ \App\Models\OrderStatus::CANCELLED }}"
                                                    {{ $order->status == \App\Models\OrderStatus::CANCELLED ? 'selected' : '' }}
                                                >
                                                    {{ \App\Models\OrderStatus::CANCELLED }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input-note" class="form-control-label">Note</label>
                                            <textarea id="input-note"
                                                      rows="4"
                                                      class="form-control @error('note') is-invalid @enderror"
                                                      name="note"
                                                      placeholder="A few notes..."
                                            >{{ $order->note ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @isset($order->staff)
                                <h6 class="heading-small text-muted mb-4">Staff info
                                    @can('view profiles')
                                        | <a href="/users/{{ $order->staff->id }}">View details</a>
                                    @endcan
                                </h6>
                                <div class="pg-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                       for="input-staff-name">Name</label>
                                                <input class="form-control"
                                                       id="input-staff-name"
                                                       placeholder="Staff name"
                                                       type="text"
                                                       disabled
                                                       value="{{ $order->staff->name ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                       for="input-staff-email">Email</label>
                                                <input class="form-control"
                                                       id="input-staff-email"
                                                       placeholder="Staff email"
                                                       type="email"
                                                       disabled
                                                       value="{{ $order->staff->email ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="pg-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="text-left">
                                            <button type="submit"
                                                    class="btn btn-primary mt-4"
                                            >
                                                Save changes
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 text-lg-right text-md-center h1 mt-4">
                                        Total: {{ number_format($order->total_bill()) . "$" }}
                                    </div>
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
