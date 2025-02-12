{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <base>
    <title>Sign In - Hotel Booking Platform</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('frontend/images/fabicon.png')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            font-family: 'Inter', sans-serif;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
        }

        .login-card h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .login-card .form-label {
            font-weight: 600;
            color: #555;
        }

        .login-card .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .login-card .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.3);
        }

        .login-card .btn-primary {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-card .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }

        .login-card .btn-google {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            color: #555;
            transition: all 0.3s ease;
        }

        .login-card .btn-google:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .login-card .btn-google img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .login-card .register-link {
            color: #6a11cb;
            font-weight: 600;
            text-decoration: none;
        }

        .login-card .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class="login-card">
            <form class="form w-100" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-center mb-4">
                    <h1>Welcome Back</h1>
                    <p class="text-muted">Sign in to continue to your hotel booking platform.</p>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        Sign In
                    </button>
                </div>
                <div class="text-center mb-4">
                    <a href="{{ route('password.request') }}" class="text-muted">Forgot Password?</a>
                </div>
                <div class="text-center mb-3">
                    <p class="text-muted">Or</p>
                </div>
                <div class="d-grid mb-4">
                    <a href="" class="btn btn-google">
                        <img src="https://img.icons8.com/color/48/google-logo.png" alt="Google Logo">
                        Continue with Google
                    </a>
                </div>
                <div class="text-center">
                    <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/assets/js/custom/toast.js') }}"></script>
    <script>
        $(document).ready(function(){
            var warnMessage = @json(Session::get('warning'));
            if(warnMessage){
                showWarningToast(warnMessage);
            }
        });
    </script>
</body>

</html>