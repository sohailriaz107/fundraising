<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .btn-custom {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
            transform: translateY(-2px);
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin: 0 auto 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="logo-circle mb-3">
                            <span>L</span>
                        </div>
                        <h3 class="text-center mb-4">Welcome Back Admin 👋</h3>

                        @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                        @endif

                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" class="form-control" placeholder="Enter your password" required>
                            </div>

                            <button type="submit" class="btn btn-custom w-100 mt-3">Login</button>
                        </form>

                        <p class="text-center text-muted mt-4 mb-0">
                            Don’t have an account? <a href="{{route('admin.register')}}" class="text-primary fw-bold text-decoration-none">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>