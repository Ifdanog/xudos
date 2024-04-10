<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Title</title>
    <style>
        .px-5 {
            padding-right: 3rem !important;
            padding-left: 24rem !important;
            padding-top: 145px;
        }


        element.style {}

        /* .mt-5 {
    margin-top: 3rem!important;
} */
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #13161D;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 10px;
            height: 15rem;
            color: white;

        }

        p {
            margin-top: 11px;
            margin-left: 56px;
            margin-bottom: 1rem;
            font-family: Montserrat;
        }

        .bg-dark {
            background: #0E0E0E;
        }

        .btn-primary {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
            margin-left: 6px;
            margin-top: 43px;
            width: 190px;
            height: 45px;
            font-family: Montserrat;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            margin-left: 11px;
            margin-top: 43px;
            width: 190px;
            height: 45px;
            font-family: Montserrat;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 4px;
            margin-left: 87px;
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
            font-family: Montserrat;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container px-5">
        {{-- <div class="image">
            <div class="form--details--right--img">
                <img src="{{ asset('assets') }}/images/6248754 1.png" alt="">
            </div>
        </div> --}}

        <div class="card col-lg-6 mt-5">
            <div class="card-header">
                <h2>Delete Cashier</h2>
            </div>
            <div class="card-body">
                <p> Are you sure you want to delete cashier?</p>
                <form action="{{ route('storeowner.delete-confirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $cashier->id }}">

                    <button type="submit" class="btn btn-danger">Yes</button>
                    <a href="{{ route('storeowner.store-dashboard') }}" class="btn btn-primary">No</a>

                </form>
            </div>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>
