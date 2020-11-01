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
                        <form>
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" id="input-username" class="form-control"
                                                   placeholder="Username"
                                                   value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email" id="input-email" class="form-control"
                                                   placeholder="email input here..."
                                                   value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">First name</label>
                                            <input type="text" id="input-first-name" class="form-control"
                                                   placeholder="First name"
                                                   value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Last name</label>
                                            <input type="text" id="input-last-name" class="form-control"
                                                   placeholder="Last name"
                                                   value="{{ $user->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4"/>
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Address</label>
                                            <input id="input-address" class="form-control" placeholder="Home Address"
                                                   value="{{ $user->address ?? '' }}" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">City</label>
                                            <input type="text" id="input-city" class="form-control" placeholder="City"
                                                   value="{{ $user->city ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Country</label>
                                            <input type="text" id="input-country" class="form-control"
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
                                    <label class="form-control-label">About Me</label>
                                    <textarea rows="4" class="form-control"
                                              placeholder="A few words about you ...">{{ $user->about_me ?? '' }}</textarea>
                                </div>
                            </div>
                        </form>
                    @endslot
                </x-card>
            </div>

            {{--            <div class="col-xl-4 order-xl-2">--}}
            {{--                @include('components.profile.user-profile-card')--}}
            {{--            </div>--}}
        </div>
    </div>
@endsection
