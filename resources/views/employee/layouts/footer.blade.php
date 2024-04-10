<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
            integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
            crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/8f90b118b8.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Get the stored CSS preference from localStorage
            var storedPreference = localStorage.getItem("cssPreference");

            // Check if the checkbox is already checked based on the stored preference
            if (storedPreference && storedPreference.includes("light")) {
                $("#check").prop("checked", true);
                $("#stores-stylesheet").attr("href", '{{asset("assets/css/stores-light.css")}}');
            }

            // Handle the checkbox change event
            $("#check").change(function() {
                if ($(this).is(":checked")) {
                    $("#stores-stylesheet").attr("href", '{{asset("assets/css/stores-light.css")}}');
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", "assets/css/stores-light.css");
                    console.log('here-1');
                } else {
                    $("#stores-stylesheet").attr("href", '{{asset("assets/css/stores.css")}}');
                    // Remove the CSS preference from localStorage
                    localStorage.removeItem("cssPreference");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Get the stored CSS preference from localStorage
            var storedPreference = localStorage.getItem("cssPreference");

            // Check if the checkbox is already checked based on the stored preference
            if (storedPreference && storedPreference.includes("light")) {
                $("#check-two").prop("checked", true);
                $("#stores-stylesheet").attr("href", '{{asset("assets/css/stores-light.css")}}');
            }

            // Handle the checkbox change event
            $("#check-two").change(function() {
                if ($(this).is(":checked")) {
                    $("#stores-stylesheet").attr("href", '{{asset("assets/css/stores-light.css")}}');
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", '{{asset("assets/css/stores-light.css")}}');
                } else {
                    $("#stores-stylesheet").attr("href", '{{asset("assets/css/stores.css")}}');
                    // Remove the CSS preference from localStorage
                    localStorage.removeItem("cssPreference");
                }
            });
        });
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8f90b118b8.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Get the stored CSS preference from localStorage
            var storedPreference = localStorage.getItem("cssPreference");

            // Check if the checkbox is already checked based on the stored preference
            if (storedPreference && storedPreference.includes("light")) {
                $("#check").prop("checked", true);
                $("#dashboard-stylesheet").attr("href", '{{asset("assets/css/dashboard-light.css")}}');
            }

            // Handle the checkbox change event
            $("#check").change(function() {
                if ($(this).is(":checked")) {
                    $("#dashboard-stylesheet").attr(
                        "href",
                        '{{asset("assets/css/dashboard-light.css")}}'
                    );
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", '{{asset("assets/css/dashboard-light.css")}}');
                } else {
                    $("#dashboard-stylesheet").attr("href", '{{asset("assets/css/dashboard.css")}}');
                    // Remove the CSS preference from localStorage
                    localStorage.removeItem("cssPreference");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Get the stored CSS preference from localStorage
            var storedPreference = localStorage.getItem("cssPreference");

            // Check if the checkbox is already checked based on the stored preference
            if (storedPreference && storedPreference.includes("light")) {
                $("#check-two").prop("checked", true);
                $("#dashboard-stylesheet").attr("href", '{{asset("assets/css/dashboard-light.css")}}');
            }

            // Handle the checkbox change event
            $("#check-two").change(function() {
                if ($(this).is(":checked")) {
                    $("#dashboard-stylesheet").attr(
                        "href",
                        '{{asset("assets/css/dashboard-light.css")}}'
                    );
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", '{{asset("assets/css/dashboard-light.css")}}');
                } else {
                    $("#dashboard-stylesheet").attr("href", '{{asset("assets/css/dashboard.css")}}');
                    // Remove the CSS preference from localStorage
                    localStorage.removeItem("cssPreference");
                }
            });
        });
    </script>
     <script src="https://kit.fontawesome.com/8f90b118b8.js" crossorigin="anonymous"></script>
     <script src={{url(asset('js/transaction.js'))}}></script>
     <script>
         $(document).ready(function() {
             // Get the stored CSS preference from localStorage
             var storedPreference = localStorage.getItem("cssPreference");

             // Check if the checkbox is already checked based on the stored preference
             if (storedPreference && storedPreference.includes("light")) {
                 $("#check").prop("checked", true);
                 $("#transaction-light").attr("href", '{{asset("assets/css/transaction-light.css")}}');
             }

             // Handle the checkbox change event
             $("#check").change(function() {
                 if ($(this).is(":checked")) {
                     $("#transaction-light").attr("href", '{{asset("assets/css/transaction-light.css")}}');
                     // Store the CSS preference in localStorage
                     localStorage.setItem("cssPreference", '{{asset("assets/css/transaction-light.css")}}');
                 } else {
                     $("#transaction-light").attr("href",' {{asset("assets/css/transaction.css")}}');
                     // Remove the CSS preference from localStorage
                     localStorage.removeItem("cssPreference");
                 }
             });
         });
     </script>
     <script>
         $(document).ready(function() {
             // Get the stored CSS preference from localStorage
             var storedPreference = localStorage.getItem("cssPreference");

             // Check if the checkbox is already checked based on the stored preference
             if (storedPreference && storedPreference.includes("light")) {
                 $("#check-two").prop("checked", true);
                 $("#transaction-light").attr("href", '{{asset("assets/css/transaction-light.css")}}');
             }

             // Handle the checkbox change event
             $("#check-two").change(function() {
                 if ($(this).is(":checked")) {
                     $("#transaction-light").attr("href", '{{asset("assets/css/transaction-light.css")}}');
                     // Store the CSS preference in localStorage
                     localStorage.setItem("cssPreference", '{{asset("assets/css/transaction-light.css")}}');
                 } else {
                     $("#transaction-light").attr("href",' {{asset("assets/css/transaction.css")}}');
                     // Remove the CSS preference from localStorage
                     localStorage.removeItem("cssPreference");
                 }
             });
         });
     </script>

     <script>
        $(document).ready(function () {
            $('#companies-table').DataTable({
                // Add any options you need here
            });
        });

    </script>


</footer>
</body>

</html>
