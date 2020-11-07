@extends('layouts.auth')

@section('auth-card')
    <div class="card bg-secondary border-0 mb-0">
        <div class="card-body px-lg-5 py-lg-5">
            <div class="text-center text-muted mb-4">
                <small>Verify email</small>
            </div>
            <div class="text-center">
                @csrf
                An email is sent to your inbox!
                <div class="text-center">
                    <button type="button" class="btn btn-primary my-4" onclick="resendVerificationEmail()">Resend
                        verification email
                    </button>
                </div>
            </div>

            <script type="javascript">
                function resendVerificationEmail() {
                    fetch('/email/verification-notification', {
                        method: 'POST'
                    }).catch(console.error)
                }
            </script>
        </div>
    </div
@endsection
