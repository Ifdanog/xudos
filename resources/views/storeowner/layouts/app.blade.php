<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets') }}/profile-css/index.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/profile-css/profile.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/profile-css/dropdown.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/profile-css/store.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Dazypay</title>
</head>

<body>
    @include('storeowner.layouts.partials.profileheader')
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
    <script>
        $("#profileImage").click(function(e) {
            $("#profileIMG").click();
        });
        $("#profileIMG").change(function(e) {
            var file = e.originalEvent.srcElement.files[0];
            // var img = $("#profileImage");
            var reader = new FileReader();
            reader.onloadend = function() {
                document.getElementById("proImg").src = reader.result;
                console.log(reader.result, 'testing1');
            }
            reader.readAsDataURL(file);
        });
    </script>
    @include('storeowner.layouts.partials.profilefooter')

</body>

</html>
