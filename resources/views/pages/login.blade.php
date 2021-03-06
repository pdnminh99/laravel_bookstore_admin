@extends('layouts.auth')

@section('auth-card')
    <div class="card bg-secondary border-0 mb-0">
        <div class="card-body px-lg-5 py-lg-5">
            <div class="text-center text-muted mb-4">
                <small>Sign in with credentials</small>
            </div>
            <form role="form" method="POST" action="/login">
                @csrf
                @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input id="email" class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               placeholder="Email" type="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input id="password" class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               placeholder="Password" type="password">
                    </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                    <input class="custom-control-input" id=" customCheckLogin" name="remember" type="checkbox">
                    <label class="custom-control-label" for=" customCheckLogin">
                        <span class="text-muted">Remember me</span>
                    </label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4">Sign in</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-6">
            <a href="#" class="text-light"><small>Forgot password?</small></a>
        </div>
        <div class="col-6 text-right">
            <a href="/register" class="text-light"><small>Create new account</small></a>
        </div>
    </div>
@endsection
