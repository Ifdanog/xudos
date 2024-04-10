<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
        <a href="/" class="logo">XUDOS 2.0</a>
        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
        <div class="move-toggle">
            <input type="checkbox" id="check-two" class="toggle-two" />
            <label for="check-two"></label>
        </div>
        <ul>
            <li><a href={{ url('/admin/dashboard') }}>Home</a></li>
            <li><a href={{ url('/admin/add-transactions') }}>Add Transactions</a></li>
            {{-- <li><a href={{ url('/clients') }}>View Clients</a></li> --}}
            {{-- <div class="dropdown">
                <a style="text-decoration: none; cursor: pointer; font-weight: 500; color: #fff"
                    class="">Management</a>
                <div class="dropdown-content">
                    <a href={{ url('cashiers') }}>Cashier</a>
                    <a href={{ url('stores') }}>Stores</a>
                </div>
            </div> --}}
            <li><a href={{ url('/admin/transactions') }}>Transactions List</a></li>
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
        .nav-right a {
            text-decoration: none;
            /* Remove underline from links */
            display: inline-block;
            /* Make links behave like block elements */
            margin-right: 5px;
            transition: background-color 0.3s, transform 0.3s, opacity 0.3s;
            /* Add smooth transitions */
        }

        .nav-right a:hover {
            background-color: #2c3e50;
            /* Change background color on hover */
            opacity: 0.8;
            /* Reduce opacity on hover */
        }

        .nav-right a i {
            color: #ffffff;
            /* Default icon color */
        }

        .nav-right a:hover i {
            transform: scale(1.2);
            /* Increase icon size on hover */
        }
    </style>
    <header class="container">
        <nav>
            <div class="nav-left">
                <div class="logo-text">XUDOS 2.0</div>
                <ul>
                    <li><a href={{ url('/admin/dashboard') }}>Home</a></li>
                    <li><a href={{ url('/admin/add-transactions') }}>Add Transactions</a></li>
                    {{-- <li><a href={{ url('/admin/clients') }}>View Clients</a></li> --}}
                    {{-- <li><a href="#">Management</a></li> --}}
                    {{-- <div class="dropdown">
                        <a style="text-decoration: none; cursor: pointer;" class="drop-a">Management</a>
                        <div class="dropdown-content">
                            <a href={{ url('cashiers') }}>Cashier</a>
                            <a href={{ url('stores') }}>Stores</a>
                        </div>
                    </div> --}}
                    <li><a href={{ url('/admin/transactions') }}>Transactions List</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <div class="toggle-switch">
                    <input type="checkbox" id="check" class="toggle" />
                    <label for="check"></label>
                </div>
                <a href="{{ url('/admin/logout') }}"
                    style="background-color: #3498db; border-radius: 5px; padding: 8px; margin-right: 5px;">
                    <i class="fa fa-sign-out" style="color: #ffffff;"></i>
                </a>
                <a href="{{ url('/admin/settings') }}"
                    style="background-color: #27ae60; border-radius: 5px; padding: 8px; margin-right: 5px;">
                    <i class="fa fa-gear" style="color: #ffffff;"></i>
                </a>
                <div class="menu-left-name" style="margin-top: 5px">
                    <p style="color: #3498db;">{{ ucwords(auth()->check() ? auth()->user()->name : 'John Leo') }}</p>
                    <p style="font-size: 9px; color: #fff; margin-top: -5px;">
                        {{ ucwords(auth()->check() ? auth()->user()->role : 'Admin') }}
                    </p>
                </div>
            </div>
            {{-- <div class="nav-right">
                <div class="toggle-switch">
                    <input type="checkbox" id="check" class="toggle" />
                    <label for="check"></label>
                </div>
                <a href={{ url('/admin/logout') }}><i class="fa fa-sign-out" style="color: #ffffff"></i></a>
                 <a href={{ url('/admin/settings') }}><i class="fa fa-gear" style="color: #ffffff"></i></a>
                <div class="menu-left-name">
                    <p>{{ ucwords(auth()->check() ? auth()->user()->name : 'John Leo') }}</p>
                    <p style="font-size: 9px; color: #fff">
                        {{ ucwords(auth()->check() ? auth()->user()->role : 'Admin') }}</p>
                </div>
            </div> --}}
        </nav>
    </header>
