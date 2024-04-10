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
    @include('cashier.layouts.partials.profileheader')
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
                document.getElementById("proImg").src =reader.result;
                console.log(reader.result, 'testing1');
            }
            reader.readAsDataURL(file);
        });

    </script>
    @include('cashier.layouts.partials.profilefooter')

</body>

</html>
