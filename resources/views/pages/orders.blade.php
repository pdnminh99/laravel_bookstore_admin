@extends('layouts.admin')

@section('header')
    @include('components.confirm-modal')
@endsection

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <x-breadcrumb :routes="[['title' => 'Order', 'active' => true]]"></x-breadcrumb>
                    @include('components.control', ['controls' => [['name' => 'Filter', 'url' => '/orders/filter']]])
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <x-card>
                    @slot('card_header')
                        Orders
                    @endslot

                    @slot('card_sub_header')
                        This table is for admins only
                    @endslot

                    <x-table :records="$orders"></x-table>

                    @slot('card_footer')
                        <x-paginator :current="$page_number" :count="$pages" route="orders"></x-paginator>
                    @endslot
                </x-card>
            </div>
        </div>
    </div>

@endsection
