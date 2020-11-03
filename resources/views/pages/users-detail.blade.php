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
                        :routes='[["title" => "User", "active" => false, "url" => "/users?page=1"], ["title" => "$user->id", "active" => false]]'></x-breadcrumb>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <x-card>
                    @slot('card_header')
                        User id {{ $user->id }}
                    @endslot

                    @slot('card_sub_header')
                        This table is for admins only
                    @endslot

                    @slot('card_body')
                        <form action="{{ $action }}" method="POST">
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

                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('address')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('phone')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('country')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('city')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('about_me')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text"
                                                   id="input-username"
                                                   name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="Username"
                                                   value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email"
                                                   id="input-email"
                                                   disabled
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="email input here..."
                                                   value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4"/>
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Address</label>
                                            <input id="input-address"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   name="address"
                                                   placeholder="Home Address"
                                                   value="{{ $user->address ?? '' }}" type="text">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Phone number</label>
                                            <input id="input-address"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   name="phone"
                                                   placeholder="Phone Number"
                                                   value="{{ $user->phone ?? '' }}" type="tel">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">City</label>
                                            <input type="text"
                                                   id="input-city"
                                                   name="city"
                                                   class="form-control @error('city') is-invalid @enderror"
                                                   placeholder="City"
                                                   value="{{ $user->city ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Country</label>
                                            <input type="text"
                                                   id="input-country"
                                                   class="form-control @error('country') is-invalid @enderror"
                                                   name="country"
                                                   placeholder="Country"
                                                   value="{{ $user->country ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4"/>
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">About me</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label for="input-about-me" class="form-control-label">About Me</label>
                                    <textarea
                                        rows="4"
                                        id="input-about-me"
                                        name="about_me"
                                        class="form-control @error('about_me') is-invalid @enderror"
                                        placeholder="A few words about you ..."
                                    >
                                        {{ $user->about_me ?? '' }}
                                    </textarea>
                                </div>

                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary mt-4">Save changes</button>
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
