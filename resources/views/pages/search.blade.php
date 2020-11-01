@extends('layouts.admin')

@section('header')
    @include('components.confirm-modal')
@endsection

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <x-breadcrumb :routes="[['title' => 'Search', 'active' => true]]"></x-breadcrumb>
                    {{--                    @include('components.control')--}}
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-6">
                <x-card>
                    @slot('card_header')
                        Books
                    @endslot

                    @slot('card_sub_header')
                        Result for {{ $keyword ?? '' }}
                    @endslot

                    <x-table :records="$books['items']"></x-table>

                    @if($books['pages'] > 1)
                        @slot('card_footer')
                            <x-paginator :count="$books['pages']"
                                         :current="$books['page_number']"
                                         route="books"></x-paginator>
                        @endslot
                    @endif
                </x-card>
            </div>

            <div class="col-6">
                <x-card>
                    @slot('card_header')
                        Orders
                    @endslot

                    @slot('card_sub_header')
                        Result for {{ $keyword ?? '' }}
                    @endslot

                    <x-table :records="$orders['items']"></x-table>

                    @if($orders['pages'] > 0)
                        @slot('card_footer')
                            <x-paginator :count="$orders['pages']"
                                         :current="$orders['page_number']"
                                         route="orders"></x-paginator>
                        @endslot
                    @endif
                </x-card>
            </div>
        </div>
    </div>

@endsection
