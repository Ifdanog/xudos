@extends('company.layouts.master')

@section('content')
    <section class="section-two">
        <div class="row-sec">
            <div class="col-sec" style="width: 80%">
                <div class="history-table">
                    <div class="table-head">
                        <p>Transactions List</p>
                        <a class="download-btn" id="download-pdf-btn"
                            style="background-color: white; color: black; cursor: pointer; text-decoration: none; padding: 8px; border-radius: 12px; margin-bottom: 10px">
                            Download PDF<i style="color: black !important; margin-left: 5px" class="fa-solid fa-download"></i>
                        </a>
                    </div>
                    <table id="company-transactions">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Fee</th>
                                <th>To</th>
                                <th>Amount</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $tx)
                                <tr>
                                    <td>{{ $tx->description }}</td>
                                    <td>{{ $tx->date }}</td>
                                    <td>{{ $tx->fee }}</td>

                                    <td>{{ $tx->to }}</td>
                                    <td style="text-align: center">$
                                        {{ number_format(str_replace(',', '', $tx->amount), 2) }}</td>

                                    <td id="action">
                                        <a href="{{ url('/admin/delete-transaction/' . $tx->id) }}">
                                            <i class="fa-solid fa-trash" style="color: #007BFF;"></i>
                                        </a>
                                        {{-- <a href="{{ url('/company/generate-receipt/' . $tx->id) }}">
                                            <i class="fa-solid fa-download" style="color: #007BFF;"></i>
                                        </a> --}}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

{{-- <style>
    .dt-buttons {
    margin-bottom: 10px; /* Add margin below the buttons */
}

/* Styling for each individual button */
.dt-button {
    background-color: #007bff; /* Change background color */
    color: #fff; /* Change text color */
    border: none; /* Remove border */
    border-radius: 4px; /* Apply border radius */
    padding: 8px 12px; /* Add padding */
    margin-right: 5px; /* Add margin between buttons */
}

/* Hover effect for buttons */
.dt-button:hover {
    background-color: #0056b3; /* Change background color on hover */
}
</style> --}}
    </section>
@endsection
