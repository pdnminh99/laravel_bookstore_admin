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
                        :routes='[["title" => "User", "active" => $user->can("view profiles") ? false : true, "url" => $user->can("view profiles") ? "/users?page=1" : null], ["title" => "$user->id", "active" => false]]'></x-breadcrumb>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <x-card>
                    @slot('card_header')
                        {{ $customer->getRoleNames()[0] ?? 'unknown role' }}
                    @endslot

                    @slot('card_sub_header')
                        {{ $customer->name }}
                    @endslot

                    @slot('card_body')
                        <form action="{{ $action }}" method="POST">
                            @csrf
                            @method('PATCH')

                            @if(session('warning'))
                                <div class="alert alert-warning" role="alert">
                                    {{ session('warning') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

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

                            @error('role')
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
                                                   value="{{ $customer->name }}">
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
                                                   value="{{ $customer->email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-role">
                                                Role
                                            </label>
                                            <select class="form-control @error('role') is-invalid @enderror"
                                                    id="input-role"
                                                    name="role"
                                                {{ \Illuminate\Support\Facades\Auth::id() != $customer->id && $user->can('edit profiles') ? '' : 'disabled' }}
                                            >
                                                <option value="{{ \App\Models\AccessRole::EDITOR }}"
                                                    {{ $customer->getRoleNames()[0] == \App\Models\AccessRole::EDITOR ? 'selected' : '' }}>
                                                    Editor
                                                </option>
                                                <option value="{{ \App\Models\AccessRole::ADMIN }}"
                                                    {{ $customer->getRoleNames()[0] == \App\Models\AccessRole::ADMIN ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                            </select>
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
                                                   value="{{ $customer->address }}" type="text">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Phone number</label>
                                            <input id="input-address"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   name="phone"
                                                   placeholder="Phone Number"
                                                   value="{{ $customer->phone }}" type="tel">
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
                                                   value="{{ $customer->city ?? '' }}">
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
                                                   value="{{ $customer->country ?? '' }}">
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
                                        {{ $customer->about_me ?? '' }}
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
