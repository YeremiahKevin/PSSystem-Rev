<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Laporan Penjualan {{ $month_name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="col-md-12 text-center">
    <h5>Laporan Penjualan {{ $month_name }}</h5>
</div>

<div class="col-md-12 mt-4">
    <table class='table table-bordered'>
        <thead>
        <tr class="text-center">
            <th width="2%">No</th>
            <th>Tanggal</th>
            <th width="30%">Item</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Tipe Pembayaran</th>
            <th>Total Pembayaran</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $idx => $transaction)
            <tr>
                <td class="text-center">{{ $idx+1 }}</td>
                <td class="text-center">{{ date('d/m/Y', strtotime($transaction->date)) }}</td>
                <td class="text-left">{{ $transaction->phone_name }}</td>
                <td class="text-right">{{ number_format($transaction->price, 0, '.', '.') }}</td>
                <td class="text-center">{{ $transaction->quantity }}</td>
                <td class="text-center">{{ $transaction->payment_type }}</td>
                <td class="text-right">{{ number_format($transaction->total_price, 0, '.', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" class="text-center font-weight-bold">TOTAL</td>
            <td class="text-right">{{ number_format($grand_total, 0, '.', '.') }}</td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>