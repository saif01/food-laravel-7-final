@extends('admin.layouts.common')

@section('title', 'Admin Login')


@section('content')

<div class="row justify-content-center">
    <div class="col-md-6 my-auto">
        <div class="card">
            <div class="card-header">Admin Login</div>

            <div class="card-body">

                @if (Session::has('loginErrorMsg'))
                <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
                    {{ Session::get('loginErrorMsg') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif



                <form method="POST" action="{{ route('admin.login.action') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="login" class="col-md-4 col-form-label text-md-right">Login ID</label>

                        <div class="col-md-6">
                            <input id="login" type="login" class="form-control @error('login') is-invalid @enderror @if(Session::has('loginErrorMsg')) is-invalid @endif" name="login" value="{{ old('login') }}"  required autocomplete="login" autofocus>

                            @error('login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
