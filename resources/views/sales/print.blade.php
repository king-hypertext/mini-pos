<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box
        }

        body {
            height: 100%;
            margin: 0 !important;
            page-break-after: avoid;
            width: 80mm;
        }

        @media print {
            @page {
                size: thermal;
                margin: 0;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                font-size: 12pt;
                width: 80mm;
            }

            .receipt-container {
                width: 100%;
                padding: 1px;
                /* border: 1px solid #ddd; */
                /* border-radius: 10px; */
            }
        }

        .page-break {
            page-break-after: avoid;
        }

        .receipt-container {
            width: 100%;
            padding: 5px;
            /* border: 1px solid #ddd; */
            /* border-radius: 10px; */
        }

        header {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        tfoot {
            font-weight: bold;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <header>
            <h1>Receipt</h1>
            <p>Company Name</p>
            <p>Date: {{ now()->format('Y-m-d H:i A') }}</p>
        </header>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale_items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td style="text-align:right;">{{ $item->quantity }}</td>
                        <td style="text-align:right;">{{ $item->unit_price }}</td>
                        <td style="text-align:right;">{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Subtotal:</th>
                    <th colspan="2" style="text-align: right">{{ 'GHS ' . number_format($sale->total, 2) }}</th>
                </tr>
                <tr>
                    <th colspan="2">Total:</th>
                    <th colspan="2" style="text-align: right">{{ 'GHS ' . number_format($sale->total, 2) }}</th>
                </tr>
            </tfoot>
        </table>
        <footer>
            <p>Thank you for your purchase!</p>
        </footer>
    </div>
</body>

</html>
