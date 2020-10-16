@extends('layouts.admin')

@section('content')

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <x-card>
                    @include('components.books-table')
                </x-card>
            </div>
        </div>
    </div>

@endsection
