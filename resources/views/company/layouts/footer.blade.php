<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
        integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8f90b118b8.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>


    {{-- <script>
        $(document).ready(function() {
            $('#download-pdf-btn').on('click', function() {
                // Create a new jsPDF instance
                var doc = new jsPDF();

                // Add a header
                doc.text('Transactions', 10, 10);

                // Get all table rows
                var rows = $('#company-transactions tbody tr');

                // Define initial y position for text
                var yPos = 20;

                // Iterate over each row and add data to the PDF
                rows.each(function(index, row) {
                    $(row).find('td').each(function(index, cell) {
                        doc.text($(cell).text(), (index * 50), yPos);
                    });
                    yPos += 10; // Increase y position for next row
                });

                // Save the PDF
                doc.save('transactions.pdf');
            });
        });
        </script> --}}
    {{-- <script src="{{ asset('assets/js/vfs_fonts.min.js') }}"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.10/jspdf.plugin.autotable.min.js"></script>

    <script>
        function generatePdf() {
            const table = document.getElementById('company-transactions');
            // const margin = 10;

            // Get the table's dimensions
            const margin = 10;
            const height = 410;
            let tableWidth = 110; // Adjust this value as needed
            const width = tableWidth + 2 * margin;

            // Create a new jsPDF instance
            const pdf = new jsPDF('p', 'mm', [width * 500, height]);

            // Add a margin to the top and left of the document
            pdf.setPage(1);
            pdf.text(margin, margin, 'Transactions List');
            pdf.setFontSize(10);

            // Get the table's data
            const tableData = [];
            const headerData = [];
            const rows = table.rows;
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].cells;
                const rowData = [];
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase() != 'action') {
                        rowData.push(cells[j].innerText);
                    }
                }
                if (i === 0) {
                    headerData.push(rowData);
                } else {
                    tableData.push(rowData);
                }
            }

            // Add the table data to the PDF document
            pdf.autoTable({
                head: headerData,
                body: tableData,
                tableWidth: width,
                margin: {
                    top: 20,
                    bottom: margin,
                    right: 20
                },
                styles: {
                    fontSize: 7,
                    cellPadding: 2
                }
            });

            // Save the PDF file
            pdf.save('transactions.pdf');
        }
        document.getElementById('download-pdf-btn').addEventListener('click', function() {
            generatePdf();
        });
    </script>
    <script>
        $(document).ready(function() {
            // Get the stored CSS preference from localStorage
            var storedPreference = localStorage.getItem("cssPreference");

            // Check if the checkbox is already checked based on the stored preference
            if (storedPreference && storedPreference.includes("light")) {
                $("#check").prop("checked", true);
                $("#stores-stylesheet").attr("href", '{{ asset('assets/css/stores-light.css') }}');
            }

            // Handle the checkbox change event
            $("#check").change(function() {
                if ($(this).is(":checked")) {
                    $("#stores-stylesheet").attr("href", '{{ asset('assets/css/stores-light.css') }}');
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", "assets/css/stores-light.css");
                    console.log('here-1');
                } else {
                    $("#stores-stylesheet").attr("href", '{{ asset('assets/css/stores.css') }}');
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
                $("#stores-stylesheet").attr("href", '{{ asset('assets/css/stores-light.css') }}');
            }

            // Handle the checkbox change event
            $("#check-two").change(function() {
                if ($(this).is(":checked")) {
                    $("#stores-stylesheet").attr("href", '{{ asset('assets/css/stores-light.css') }}');
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", '{{ asset('assets/css/stores-light.css') }}');
                } else {
                    $("#stores-stylesheet").attr("href", '{{ asset('assets/css/stores.css') }}');
                    // Remove the CSS preference from localStorage
                    localStorage.removeItem("cssPreference");
                }
            });
        });
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap.min.js">
    </script>
    <script src="https://kit.fontawesome.com/8f90b118b8.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Get the stored CSS preference from localStorage
            var storedPreference = localStorage.getItem("cssPreference");

            // Check if the checkbox is already checked based on the stored preference
            if (storedPreference && storedPreference.includes("light")) {
                $("#check").prop("checked", true);
                $("#dashboard-stylesheet").attr("href", '{{ asset('assets/css/dashboard-light.css') }}');
            }

            // Handle the checkbox change event
            $("#check").change(function() {
                if ($(this).is(":checked")) {
                    $("#dashboard-stylesheet").attr(
                        "href",
                        '{{ asset('assets/css/dashboard-light.css') }}'
                    );
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", '{{ asset('assets/css/dashboard-light.css') }}');
                } else {
                    $("#dashboard-stylesheet").attr("href", '{{ asset('assets/css/dashboard.css') }}');
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
                $("#dashboard-stylesheet").attr("href", '{{ asset('assets/css/dashboard-light.css') }}');
            }

            // Handle the checkbox change event
            $("#check-two").change(function() {
                if ($(this).is(":checked")) {
                    $("#dashboard-stylesheet").attr(
                        "href",
                        '{{ asset('assets/css/dashboard-light.css') }}'
                    );
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", '{{ asset('assets/css/dashboard-light.css') }}');
                } else {
                    $("#dashboard-stylesheet").attr("href", '{{ asset('assets/css/dashboard.css') }}');
                    // Remove the CSS preference from localStorage
                    localStorage.removeItem("cssPreference");
                }
            });
        });
    </script>
    <script src="https://kit.fontawesome.com/8f90b118b8.js" crossorigin="anonymous"></script>
    <script src={{ url(asset('js/transaction.js')) }}></script>
    <script>
        $(document).ready(function() {
            // Get the stored CSS preference from localStorage
            var storedPreference = localStorage.getItem("cssPreference");

            // Check if the checkbox is already checked based on the stored preference
            if (storedPreference && storedPreference.includes("light")) {
                $("#check").prop("checked", true);
                $("#transaction-light").attr("href", '{{ asset('assets/css/transaction-light.css') }}');
            }

            // Handle the checkbox change event
            $("#check").change(function() {
                if ($(this).is(":checked")) {
                    $("#transaction-light").attr("href",
                        '{{ asset('assets/css/transaction-light.css') }}');
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference",
                        '{{ asset('assets/css/transaction-light.css') }}');
                } else {
                    $("#transaction-light").attr("href", ' {{ asset('assets/css/transaction.css') }}');
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
                $("#transaction-light").attr("href", '{{ asset('assets/css/transaction-light.css') }}');
            }

            // Handle the checkbox change event
            $("#check-two").change(function() {
                if ($(this).is(":checked")) {
                    $("#transaction-light").attr("href",
                        '{{ asset('assets/css/transaction-light.css') }}');
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference",
                        '{{ asset('assets/css/transaction-light.css') }}');
                } else {
                    $("#transaction-light").attr("href", ' {{ asset('assets/css/transaction.css') }}');
                    // Remove the CSS preference from localStorage
                    localStorage.removeItem("cssPreference");
                }
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#company-transactions').DataTable({
                // dom: 'Bfrtip',
                // buttons: ['copy', 'csv', 'excel', 'pdf']
            });
        });
    </script>


</footer>
</body>

</html>
