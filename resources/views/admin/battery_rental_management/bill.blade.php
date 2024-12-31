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
                <img src="{{ Storage::url($companyDetails->company_logo) }}" alt="Hotel Logo"
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
            <p><span class="label">Rental ID:</span> BR{{ $rental->public_id }}</p>
        </div>

        <!-- Section 1: Customer Details -->
        <div class="section">
            <h2>Customer Details</h2>
            <table>
                <tr>
                    <td class="label">Name:</td>
                    <td>{{ $rental->customer->first_name }} {{ $rental->customer->last_name }}</td>
                    <td class="label">Contact:</td>
                    <td>{{ $rental->customer->phone_number }}</td>
                </tr>
            </table>
        </div>

        <!-- Section 2: rental Details -->
        <div class="section">
            <h2>Rental Details</h2>
            <table>
                <tr>
                    <td class="label">Battery Type :</td>
                    <td>{{ $rental->oldBattery->old_battery_type }}</td>
                </tr>
                <td class="label">Condition:</td>
                <td>{{ $rental->oldBattery->old_battery_condition }}</td>
                </tr>
                <td class="label">Battery Value:</td>
                <td>{{ $rental->oldBattery->old_battery_value }}</td>
                </tr>
                <tr>
                    <td class="label">Rental Start Date:</td>
                    <td>{{ $rental->rental_start_date }}</td>
                </tr>
                <td class="label">Rental End Date:</td>
                <td>{{ $rental->rental_end_date }}</td>
                </tr>
                @if (!empty($rental->actual_return_date))
                    <tr>
                        <td class="label">Actual Return Date:</td>
                        <td>{{ $rental->actual_return_date }}</td>
                    </tr>
                @endif
            </table>
        </div>


        <!-- Section 3: Charges Summary -->
        <div class="section">
            <h2>Charges Summary</h2>
            <table>
                <tr>
                    <td class="label">Rental Cost (LKR):</td>
                    <td style="text-align: right;">{{ $rental->rental_cost }}</td>
                </tr>
                @if (!empty($rental->late_return_fee))
                    <tr>
                        <td class="label">Late Return Fee (LKR):</td>
                        <td style="text-align: right;">{{ $rental->late_return_fee }}</td>
                    </tr>
                @endif
                @if (!empty($rental->damage_fee))
                    <tr>
                        <td class="label">Damage Fee (LKR):</td>
                        <td style="text-align: right;">{{ $rental->damage_fee }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="label">Total Cost (LKR):</td>
                    <td style="text-align: right;">{{ $rental->total_cost ?? '0' }}</td>
                </tr>

            </table>
        </div>

        <!-- Section 4: Payment Details -->
        <div class="section">
            <h2>Payment Details</h2>
            <table>
                <tr>
                    <td class="label">Payment Type:</td>
                    <td style="text-align: right;">{{ $rental->payment_type }}</td>
                </tr>
                <tr>
                    <td class="label">Payment Date:</td>
                    <td style="text-align: right;">{{ $rental->updated_at }}</td>
                </tr>
                <tr>
                    <td class="label">Paid Amount (LKR):</td>
                    <td style="text-align: right;">{{ $rental->paid_amount ?? '0' }}</td>
                </tr>
                <tr>
                    <td class="label">Advance Amount (LKR):</td>
                    <td style="text-align: right;">{{ $rental->advance_amount ?? '0' }}</td>
                </tr>
                <tr>
                    <td class="label">Due Amount (LKR):</td>
                    <td style="text-align: right;">{{ $rental->due_amount ?? '0' }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you for choosing New York Guest House & Restaurant. We hope you had a pleasant stay!</p>

        </div>
    </div>

    <script>
        window.print(); // Automatically trigger print dialog

        // After printing, redirect to the bookings list
        window.onafterprint = function() {
            window.location.href =
                "{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}";
        };
    </script>

</body>

</html>
