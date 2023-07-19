<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Example Email</title>
</head>

<body>
    <h4>Example Testing Email</h4>
    <p>Your invoice (#{{ $invoice->id }}) has been confirmed.
    </p>

    <table border="1">
        <tr>
            <th>ID</th>
            <td>{{ $invoice->id }}</td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>{{ $invoice->total_amount }}</td>
        </tr>
        <tr>
            <th>(-) Discount</th>
            <td>{{ $invoice->total_amount }}</td>
        </tr>
        <tr>
            <th>(+) Tax</th>
            <td>{{ $invoice->tax_amount }}</td>
        </tr>
        <tr>
            <th>Subtotal Amount</th>
            <td>{{ $invoice->sub_total_amount }}</td>
        </tr>
        <tr>
            <th>Note</th>
            <td>{{ $invoice->note }}</td>
        </tr>
    </table>

    <p>Note: you can see more details from the <a href="{{ config('app.url') }}">{{ config('app.name') }}</a></p>

    <p>Thank you.</p>
</body>

</html>
