<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/Cards.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/store dashboard.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/transaction.css">
    <!-- <link rel="stylesheet" href="/style/Cashier.css"> -->
    <!-- <link rel="stylesheet" href="/style/calender.css"> -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/store.css">
    <!-- <style>
    #addCashier {
      position: absolute;
      bottom: 1064%;
    }
  </style> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Store Dashboard</title>
</head>
<style>

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
    @yield('content')
    @include('storeowner.layouts.partials.footer')
</body>

</html>
