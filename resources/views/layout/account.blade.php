<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/global.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/signin.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>signin</title>
    <style>

    </style>
</head>

<body>
    <div class="container">
        <style>
            .alert {
                position: fixed;
                top: 80px;
                right: 10px;
                width: 300px;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                z-index: 9999;
            }

            .alert-success {
                background-color: #28a745;
                color: #fff;
            }

            .alert-danger {
                background-color: #dc3545;
                color: #fff;
            }
        </style>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="cenTer">
            <div class="center-background">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
