<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Email Confirmation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <main class="container">
        <h4>Hello {User},</h4>
        <p>Your invoice (#{{ $invoice->id }}) has been confirmed.
        </p>

        <table class="table table-bordered">
            <tr>
                <th>Total Amount</th>
                <td class="text-end">{{ $invoice->total_amount }} tk</td>
            </tr>
            <tr>
                <th>(-) Discount</th>
                <td class="text-end">{{ $invoice->total_amount }} tk</td>
            </tr>
            <tr>
                <th>(+) Tax</th>
                <td class="text-end">{{ $invoice->tax_amount }} tk</td>
            </tr>
            <tr>
                <th>Subtotal Amount</th>
                <td class="text-end">{{ $invoice->sub_total_amount }} tk</td>
            </tr>
            <tr>
                <td>Invoice Note</td>
                <td class="text-end">{{ $invoice->note }}</td>
            </tr>
        </table>

        <p>Note: you can see more details from the <a href="{{ config('app.url') }}">{{ config('app.name') }}</a></p>

        <p>Thank you.</p>

        {{-- dev note for project reviewer team --}}
        <hr>
        <p>DevNotes: <u>It is possible to make a pdf of the invoice and attach a link here to download the invoice.</u></p>
        <hr>


    </main>
</body>

</html>
