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

                    <x-table :records="$books"></x-table>
                </x-card>
            </div>

            <div class="col-6">
                <x-card>
                    @slot('card_header')
                        Table
                    @endslot

                    @slot('card_sub_header')
                        Orders
                    @endslot

                    <x-table :records="$orders"></x-table>
                </x-card>
            </div>
        </div>

        <div class="row">
            <div class="col-{{ \Illuminate\Support\Facades\Auth::user()->can('view profiles') ? '6' : '12' }}">
                <x-card>
                    @slot('card_header')
                        Table
                    @endslot

                    @slot('card_sub_header')
                        Categories
                    @endslot

                    <x-table :records="$categories"></x-table>
                </x-card>
            </div>

            @if(\Illuminate\Support\Facades\Auth::user()->can('view profiles'))
                <div class="col-6">
                    <x-card>
                        @slot('card_header')
                            Table
                        @endslot

                        @slot('card_sub_header')
                            Customers
                        @endslot

                        <x-table :records="$customers"></x-table>
                    </x-card>
                </div>
            @endif
        </div>
    </div>

@endsection
