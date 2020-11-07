@extends('layouts.admin')

@section('header')
    @include('components.confirm-modal')
@endsection

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <x-breadcrumb :routes="[['title' => 'Category', 'active' => true]]"></x-breadcrumb>
                    @include('components.control', ['controls' => [['name' => 'New', 'url' => '/categories/create']]])
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <x-card>
                    @slot('card_header')
                        tables
                    @endslot

                    @slot('card_sub_header')
                        Categories
                    @endslot

                    @if(session('success'))
                        <div class="col-lg">
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    @if (count($categories) == 0)
                        @slot('card_body')
                            <div class="text-center">
                                <img class="rounded" src="{{ asset('/img/icons/nothing-here.png') }}"
                                     alt="empty-data">
                            </div>
                        @endslot
                    @else
                        <x-table :records="$categories"></x-table>
                    @endif

                    @if($pages > 1)
                        @slot('card_footer')
                            <x-paginator :current="$page_number" :count="$pages" route="categories"></x-paginator>
                        @endslot
                    @endif
                </x-card>
            </div>
        </div>
    </div>

@endsection
