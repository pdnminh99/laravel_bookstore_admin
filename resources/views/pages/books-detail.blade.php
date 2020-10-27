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
                        :routes='[["title" => "Book", "active" => false, "url" => "/books?page=1"], ["title" => "$id", "active" => false]]'></x-breadcrumb>
                    @include('components.control')
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <x-card>
                    @slot('card_header')
                        Book id {{ $id }}
                    @endslot

                    @slot('card_sub_header')
                        This table is for admins only
                    @endslot

                    @slot('card_footer')
                        Footer
                    @endslot
                </x-card>
            </div>
        </div>
    </div>

@endsection
