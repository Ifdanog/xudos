<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <title>cashier dashbord</title>
    <style>
        /* Add this to your CSS */
        .modal {
            transition: opacity 0.3s ease;
        }

        .modal-dialog {
            max-width: 400px;
        }

        .modal-content {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card col-lg-8">
            <div class="card-header">
                <h2>Cashier Management</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Cashier Id</th>
                            <th scope="col">Cashier Name</th>
                            <th scope="col">created At</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->user->contact }}</td>
                                <td>

                                    <a class="btn btn-outline-warning btn-square btn-xs"
                                        href="{{ route('storeowner.edit-cashier', $item->id) }}">Edit&nbsp;<i
                                            class="fa fa-pencil"></i></a>
                                    {{-- {{ route('storeowner.delete-cashier', $item->id) }} --}}
                                    <a class="btn btn-outline-danger btn-square btn-xs" href="#"
                                        id="del-btn">Delete&nbsp;<i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
            </div>
            </tbody>
            </table>
            <form action="{{ route('storeowner.logout') }}" method="POST">
                @csrf
                <button type="submit">logout</button>
            </form>

        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#del-btn").click(function(e) {
                e.preventDefault();
                $("#del-cashier").fadeIn();
            });

            $("#delCloseBtn").click(function() {
                $("#del-cashier").fadeOut();
            });

        });
    </script>

</body>

</html>
