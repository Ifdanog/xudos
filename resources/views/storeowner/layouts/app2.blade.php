<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/Cards.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/store dashboard.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/transaction.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/dropdown.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/store.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <title>Store Dashboard</title>
</head>
<style>
    .component-option {
        position: relative;
        left: 173px;
        cursor: pointer;
        bottom: 17px;
    }

    .component-option2 {
        cursor: pointer;
        position: relative;
    }

    .slash-img {
        position: relative;
        right: 35px;
    }

    .slash-img-1 {
        position: relative;
        top: 56px;
        left: 34px;
    }

    .slash-img-2 {
        position: relative;
    top: 56px;
    left: 75px;

    }

    .slash-img-3 {
        position: relative;
        top: 56px;
    left: 75px;
    }

    .loader {
        pointer-events: none;
        animation: an1 1s ease infinite;
    }

    @keyframes an1 {
        0% {
            transform: rotate(0turn);
        }

        100% {
            transform: rotate(1turn);
        }
    }
</style>

<style>
    .component-option.active {
        text-decoration: underline;
    }

    .component-option:hover {
        /* cursor: pointer; */
        /* text-decoration: underline; */
    }

    .component-option2.active {
        text-decoration: underline;
    }

    .component-option2:hover {
        /* cursor: pointer; */
        /* text-decoration: underline; */
    }
</style>

<body>
    @include('storeowner.layouts.partials.header')
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
    @yield('content')
    @include('storeowner.layouts.partials.footer')
</body>

</html>
