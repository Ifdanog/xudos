<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        .receipt-container {
            width: 70%;
            margin: auto;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .receipt-header {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #3498db;
        }

        .receipt-details {
            margin-bottom: 15px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .receipt-details div {
            width: 48%;
            margin-bottom: 10px;
        }

        .receipt-details p {
            margin: 5px 0;
            font-size: 1em;
        }

        .receipt-total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
            color: #27ae60;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h2>Receipt</h2>
        </div>
        <div class="receipt-details">
            <div>
                <p><strong>Client Name:</strong> {{ $transaction->user->name }}</p>
            </div>
            <div>
                <p><strong>Date:</strong> {{ date('Y-m-d', strtotime($transaction->created_at)) }}</p>
            </div>
            <div>
                <p><strong>Address:</strong>
                    {{ $transaction->street . ', ' . $transaction->city . ', ' . $transaction->country }}</p>
            </div>
            <div>
                <p><strong>Contract No:</strong> {{ $transaction->contract_no }}</p>
            </div>
            <div>
                <p><strong>Security Deposit:</strong> {{ number_format((float) $transaction->security_benefit, 2) }} EUR
                </p>
            </div>
        </div>
        <div class="receipt-total">
            <p><strong>Monthly Payment:</strong> {{ number_format($transaction->monthly_payment, 2) }} EUR</p>
        </div>
        <style>
            .download-button {
                padding: 10px 20px;
                background-color: #3498db;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;

            }

            .download-button:hover {
                background-color: #2980b9;

            }

            @media print {
                .download-button {
                    display: none;
                }
            }
        </style>

        <div>
            <button class="download-button" onclick="window.print()">Download</button>
        </div>
    </div>
</body>

</html>
