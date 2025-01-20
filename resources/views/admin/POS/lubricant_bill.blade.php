



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lubricant Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .bill-container {
            width: 210mm;
            padding: 25mm;
            box-sizing: border-box;
            margin: auto;
            border: 1px solid #000;
            page-break-inside: avoid;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }

        .logo img {
            width: 100px;
        }

        .company-info {
            text-align: right;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 14px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .bill-container {
                border: none;
                padding: 20mm;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="bill-container">
        <div class="header">
            <div class="logo">
                <img src="https://via.placeholder.com/100" alt="Company Logo">
            </div>
            {{-- <div class="company-info">
                <h1>{{ $lubricantOrder->company_name }}</h1>
                <p>{{ $lubricantOrder->company_address }}</p>
                <p>{{ $lubricantOrder->company_email }}</p>
                <p>{{ $lubricantOrder->company_phone }}</p>
            </div> --}}
        </div>

        <!-- Date and Bill Number -->
        <div class="section" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <p><span class="label">Date:</span> {{ $lubricantOrder->created_at }}</p>
            <p><span class="label">Order No:</span> {{ $lubricantOrder->order_id }}</p>
        </div>

        <div class="section">
            <h2>Customer Details</h2>
            <table>
                <tr>
                    <td>Name:</td>
                    <td>{{ $lubricantOrder->first_name }}</td>
                    <td>Contact:</td>
                    <td>{{ $lubricantOrder->phone_number }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>Lubricant Details</h2>
            <table>
                <thead>
                    <tr>
                        <th>Lubricant Name</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lubricantOrderDetails as $lubricant)
                    <tr>
                      
                        <td>{{ $lubricant->name }}</td>
                       
                        <td>{{ $lubricantOrder->brand_name }}</td>
                        <td>{{ $lubricantOrder->mesurement_type }}</td>
                        <td>{{ $lubricantOrder->unit }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Charges Summary</h2>
            <table>
                <tr>
                    <td>Total Price (LKR)</td>
                    <td>{{ $lubricantOrder->total_price }}</td>
                </tr>
                <tr>
                    <td>Paid Amount (LKR)</td>
                    <td>{{ $lubricantOrder->paid_amount }}</td>
                </tr>
                <tr>
                    <td>Due Amount (LKR)</td>
                    <td>{{ $lubricantOrder->due_amount }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>Payment Details</h2>
            <table>
                <tr>
                    <td>Payment Type</td>
                    <td>{{ $lubricantOrder->payment_type }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>

    <script>
        window.print();
        window.onafterprint = function () {
            window.location.href = "/admin/POS/lubricant-order";
        };
    </script>
</body>

</html>
