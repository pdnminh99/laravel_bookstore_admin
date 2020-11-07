@extends('layouts.admin')

@section('header')
    @include('components.confirm-modal')
@endsection

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <x-breadcrumb :routes="[['title' => 'User', 'active' => true]]"></x-breadcrumb>
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
                        Users
                    @endslot

                    @if (count($users) == 0)
                        @slot('card_body')
                            <div class="text-center">
                                <img class="rounded" src="{{ asset('/img/icons/nothing-here.png') }}"
                                     alt="empty-data">
                            </div>
                        @endslot
                    @else
                        <x-table :records="$users"></x-table>
                    @endif

                    @if($pages > 1)
                        @slot('card_footer')
                            <x-paginator :current="$page_number" :count="$pages" route="users"></x-paginator>
                        @endslot
                    @endif
                </x-card>
            </div>
        </div>
    </div>

@endsection
