<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking Invoice</title>
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
                <img src="{{ Storage::url($companyDetails->company_logo ?? '') }}" alt="Hotel Logo"
                    style="width: 100px; height: auto;">
            </div>
            <div class="company-info">
                <h1>{{ $companyDetails->company_name ?? '' }}</h1>
                <p>{{ $companyDetails->address ?? '' }}</p>
                <p>{{ $companyDetails->email ?? '' }}</p>
                <p>{{ $companyDetails->contact ?? '' }}</p>

            </div>
        </div>

        <!-- Date and Bill Number -->
        <div class="section" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <p><span class="label">Date:</span> {{ $currentDateTime }}</p>
            <p><span class="label">Old Battery ID:</span> OB{{ $oldBattery->id }}</p>
        </div>

        <!-- Section 1: Customer Details -->
        <div class="section">
            <h2>Customer Details</h2>
            <table>
                <tr>
                    <td class="label">Name:</td>
                    <td>{{ $oldBattery->customer->first_name }} {{ $oldBattery->customer->last_name }}</td>
                    <td class="label">Contact:</td>
                    <td>{{ $oldBattery->customer->phone_number }}</td>
                </tr>
            </table>
        </div>

        <!-- Section 2: oldBattery Details -->
        <div class="section">
            <h2>Old Battery Details</h2>
            <table>
                <tr>
                    <td class="label">Battery Type:</td>
                    <td>{{ $oldBattery->old_battery_type }}</td>
                </tr>
                <tr>
                    <td class="label">Condition:</td>
                    <td>{{ $oldBattery->old_battery_condition }}</td>
                </tr>
                <tr>
                    <td class="label">Value:</td>
                    <td>{{ $oldBattery->old_battery_value }}</td>
                </tr>
                <tr>

            </table>
        </div>


        <!-- Section 3: Charges Summary -->
        <div class="section">
            <h2>Charges Summary</h2>
            <table>
                @if (!empty($oldBattery->old_battery_value))
                    <tr>
                        <td class="label">Old Battery Cost (LKR):</td>
                        <td style="text-align: right;">{{ $oldBattery->old_battery_value }}</td>
                    </tr>
                @endif

            </table>
        </div>

        <!-- Section 4: Payment Details -->
        {{-- <div class="section">
            <h2>Payment Details</h2>
            <table>
                <tr>
                    <td class="label">Payment Type:</td>
                    <td style="text-align: right;">{{ $oldBattery->payment_type }}</td>
                </tr>
                <tr>
                    <td class="label">Payment Date:</td>
                    <td style="text-align: right;">{{ $oldBattery->updated_at }}</td>
                </tr>
                @if (!empty($oldBattery->paid_amount) && $oldBattery->paid_amount > 0)
                    <tr>
                        <td class="label">Paid Amount (LKR):</td>
                        <td style="text-align: right;">{{ $oldBattery->paid_amount ?? '0' }}</td>
                    </tr>
                @endif
                @if (!empty($oldBattery->advance_amount))
                    <tr>
                        <td class="label">Advance Amount (LKR):</td>
                        <td style="text-align: right;">{{ $oldBattery->advance_amount ?? '0' }}</td>
                    </tr>
                @endif
                @if (!empty($oldBattery->due_amount) && $oldBattery->due_amount > 0)
                    <tr>
                        <td class="label">Due Amount (LKR):</td>
                        <td style="text-align: right;">{{ $oldBattery->due_amount ?? '0' }}</td>
                    </tr>
                @endif
            </table>
        </div> --}}

        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you for choosing Premium Battery. We hope you had a pleasant stay!</p>

        </div>
    </div>

    <script>
        window.print(); // Automatically trigger print dialog

        // After printing, redirect to the bookings list
        window.onafterprint = function() {
            window.location.href =
                "{{ request()->query('ref') === 'view' ? route('oldBatteries.show', $oldBattery->id) : route('oldBatteries.index') }}";
        };
    </script>

</body>

</html>
