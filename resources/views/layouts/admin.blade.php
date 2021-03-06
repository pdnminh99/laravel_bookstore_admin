@extends('layouts.shared')

@section('body')
    @hasSection('header')
        @yield('header')
    @endif

    <x-side-nav></x-side-nav>

    <div class="main-content" id="panel">
        <x-top-nav :user="$user" keyword="{{ $keyword ?? '' }}"></x-top-nav>
        @hasSection('content')
            @yield('content')
        @endif
    </div>
@endsection
