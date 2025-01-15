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
            margin: 10;
            padding: 0;
        }

        .bill-container {
            width: 210mm;
            height: 297mm;
            padding: 25mm;
            box-sizing: border-box;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }

        .header .logo {
            width: 100px;
        }

        .header .company-info {
            text-align: right;
        }

        .header .company-info h1 {
            margin: 0;
            font-size: 18px;
        }

        .header .company-info p {
            margin: 1px 0;
        }

        .section {
            margin-bottom: 10px;
        }

        .section h2 {
            font-size: 14px;
            text-decoration: underline;
            margin-bottom: 10px;
        }

        .section table {
            width: 100%;
            border-collapse: collapse;
        }

        .section table,
        .section table th,
        .section table td {
            border: 1px solid #000;
        }

        .section table th,
        .section table td {
            padding: 7px;
            text-align: left;
        }

        .section .label {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
        }

        .footer .prepared-by {
            margin-top: 10px;
            font-weight: bold;
            text-align: left;
        }

        @media print {
            .bill-container {
                border: none;
                padding: 25px;
                margin: 0;
                width: 100%;
                height: auto;
            }

            .header {
                border-bottom: 2px solid #000;
            }
        }
    </style>
</head>

<body>

    <div class="bill-container">
        <!-- Header Section -->
        <div class="header">
            <div class="logo">
                <img src="https://via.placeholder.com/100" alt="Company Logo" style="width: 100px; height: auto;">
            </div>
            <div class="company-info">
                {{-- <h1>{{ $lubricantOrder->company_name }}</h1>
                <p>{{ $lubricantOrder->company_address }}</p>
                <p>{{ $lubricantOrder->company_email }}</p>
                <p>{{ $lubricantOrder->company_phone }}</p> --}}
            </div>
        </div>

        <!-- Date and Bill Number -->
        <div class="section" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <p><span class="label">Date:</span> {{ $lubricantOrder->created_at }}</p>
            <p><span class="label">Order No:</span> {{ $lubricantOrder->order_id }}</p>
        </div>

        <!-- Section 1: Customer Details -->
        <div class="section">
            <h2>Customer Details</h2>
            <table>
                <tr>
                    <td class="label">Name:</td>
                    <td>{{ $lubricantOrder->first_name }}</td>
                    <td class="label">Contact:</td>
                    <td>{{ $lubricantOrder->phone_number }}</td>
                    <td>{{ $lubricantOrder->lubricant_name }}</td>
                </tr>
            </table>
        </div>

        <!-- Section 2: Lubricant Details -->
        <div class="section">
            <h2>Lubricant Details</h2>
            <table>
                {{-- <tr>
                    <td class="label">Lubricant Name:</td>
                    <td>{{ $lubricantOrder->lubricant_name }}</td>
                    <td class="label">Brand:</td>
                    <td>{{ $lubricantOrder->brand_name }}</td>
                </tr> --}}

                @foreach($lubricantOrderDetails as $lubricant)
                <tr>
                 
                    <td class="label">Lubricant Name:</td>
                    <td>{{ $lubricant->name }}</td>
                   
                    <td class="label">Brand:</td>
                    <td>{{ $lubricantOrder->brand_name }}</td>
                </tr>
                @endforeach
                {{-- <tr>
                    <td class="label">Purchase Price:</td>
                    <td>{{ $lubricantOrder->purchase_price }}</td>
                    <td class="label">Sale Price:</td>
                    <td>{{ $lubricantOrder->sale_price }}</td>
                </tr> --}}
                
                <tr>
                    <td class="label">Type :</td>
                    <td>{{ $lubricantOrder->mesurement_type }}</td>
                    <td class="label">Quantity:</td>
                    <td>{{ $lubricantOrder->unit }}</td>
                </tr>
            </table>
        </div>

        <!-- Section 3: Charges Summary -->
        <div class="section">
            <h2>Charges Summary</h2>
            <table>
                <tr>
                    <td class="label">Total Price (LKR):</td>
                    <td style="text-align: right;">{{ $lubricantOrder->total_price }}</td>
                </tr>
                <tr>
                    <td class="label">Paid Amount (LKR):</td>
                    <td style="text-align: right;">{{ $lubricantOrder->paid_amount }}</td>
                </tr>
                <tr>
                    <td class="label">Due Amount (LKR):</td>
                    <td style="text-align: right;">{{ $lubricantOrder->due_amount }}</td>
                </tr>
                <tr>
                    <td class="label"><strong>Total Cost (LKR):</strong></td>
                    <td style="text-align: right;"><strong>{{ $lubricantOrder->total_price }}</strong></td>
                </tr>
              
            </table>
        </div>

        <!-- Section 4: Payment Details -->
        <div class="section">
            <h2>Payment Details</h2>
            <table>
                <tr>
                    <td class="label">Payment Type:</td>
                    <td style="text-align: right;">{{ $lubricantOrder->payment_type }}</td>
                </tr>
                
                <tr>
                    <td class="label">Paid Amount (LKR):</td>
                    <td style="text-align: right;">{{ $lubricantOrder->paid_amount }}</td>
                </tr>
                <tr>
                    <td class="label">Due Amount (LKR):</td>
                    <td style="text-align: right;">{{ $lubricantOrder->due_amount }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer Section -->
      
    </div>

    <script>
        window.print(); // Automatically trigger print dialog

        // After printing, redirect to the orders list
        window.onafterprint = function() {
            window.location.href = "/admin/POS/lubricant-order"; // Update with actual URL
        };
    </script>

</body>

</html>
