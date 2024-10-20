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
        }

        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            body {
                font-family: Courier;
                font-size: 12pt;
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
            <p>Date: ${date}</p>
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
                <tr>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>${item.price}</td>
                    <td>${(item.price * item.quantity).toFixed(2)}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Subtotal:</th>
                    <th>${subtotal}</th>
                </tr>
                <tr>
                    <th colspan="3">Total:</th>
                    <th>${total}</th>
                </tr>
            </tfoot>
        </table>
        <footer>
            <p>Thank you for your purchase!</p>
        </footer>
    </div>
</body>

</html>
