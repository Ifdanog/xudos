<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
        integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
        crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap.min.css">
    <link id="dashboard-stylesheet" rel="stylesheet" href={{ url(asset('assets/css/dashboard.css')) }} />
    <link id="stores-stylesheet" rel="stylesheet" href={{ url(asset('assets/css/stores.css')) }} />
    <link id="transaction-light" rel="stylesheet" href={{ url(asset('assets/css/transaction.css')) }} />

    {{-- <link rel="stylesheet" href="./../style/profile.css">
     <link rel="stylesheet" href="./../style/dropdown.css">
     <link rel="stylesheet" href="./../style/store.css"> --}}


</head>

<body>
    <header class="header">
        <a href="/" class="logo">MTC</a>
        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
        <div class="move-toggle">
            <input type="checkbox" id="check-two" class="toggle-two" />
            <label for="check-two"></label>
        </div>
        <ul>
            <li><a href={{ url('/dashboard') }}>Register Companies</a></li>
            <li><a href={{ url('/companies') }}>View Companies</a></li>
            <div class="dropdown">
                <a style="text-decoration: none; cursor: pointer; font-weight: 500; color: #fff"
                    class="">Management</a>
                <div class="dropdown-content">
                    <a href={{ url('cashiers') }}>Cashier</a>
                    <a href={{ url('stores') }}>Stores</a>
                </div>
            </div>
            <li><a href={{ url('/transactions') }}>Transactions</a></li>
        </ul>
    </header>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
            margin-right: 10px
        }

        .drop-a:hover {
            color: inherit;
        }

        .dropdown-btn {
            background-color: transparent;
            color: white;

            border: none;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            font-family: 'Montserrat', sans-serif !important;
            font-size: 12px !important;
            font-weight: 500;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: black;
            min-width: 160px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #333333;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
    <header class="container">
        <nav>
            <div class="nav-left">
                <div class="logo-text">MTC</div>
                <ul>
                    <li><a href={{ url('/dashboard') }}>Register Companies</a></li>
                    <li><a href={{ url('/companies') }}>View Companies</a></li>
                    {{-- <li><a href="#">Management</a></li> --}}
                    <div class="dropdown">
                        <a style="text-decoration: none; cursor: pointer;" class="drop-a">Management</a>
                        <div class="dropdown-content">
                            <a href={{ url('cashiers') }}>Cashier</a>
                            <a href={{ url('stores') }}>Stores</a>
                        </div>
                    </div>
                    <li><a href={{ url('/transactions') }}>Transactions</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <div class="toggle-switch">
                    <input type="checkbox" id="check" class="toggle" />
                    <label for="check"></label>
                </div>
                <a href={{ url('/logout') }}><i class="fa fa-sign-out" style="color: #ffffff"></i></a>
                <a href={{ url('/settings') }}><i class="fa fa-gear" style="color: #ffffff"></i></a>
                <div class="menu-left-name">
                    <p>{{ ucwords(auth()->check() ? auth()->user()->name : 'John Leo') }}</p>
                    <p style="font-size: 9px; color: #fff">
                        {{ ucwords(auth()->check() ? auth()->user()->role : 'Admin') }}</p>
                </div>
            </div>
        </nav>
    </header>
