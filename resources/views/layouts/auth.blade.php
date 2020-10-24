@extends('layouts.shared')

@include('components.auth.nav')

<div class="main-content">
    @include('components.auth.banner')
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                @hasSection('auth-card')
                    @yield('auth-card')
                @endif
            </div>
        </div>
    </div>
</div>

@include('components.auth.footer')
