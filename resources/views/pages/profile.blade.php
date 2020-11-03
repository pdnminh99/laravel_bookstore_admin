@extends('layouts.admin')

@section('content')
    @include('components.profile.header')

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <x-card :card_action="['route'=>'', 'name' => 'Save']">
                    @slot('card_header')
                        Edit profile
                    @endslot

                    @slot('card_sub_header')
                        {{ $user->name }}
                    @endslot

                    @slot('card_body')
                        <form action="/profile" method="POST">
                            @method('PATCH')
                            @csrf

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
@endsection
