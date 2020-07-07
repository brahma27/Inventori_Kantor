<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div style="padding-top:30px;" class="container-fluid">
        <center>
            <h2>Data Bahan Keluar</h2>
            <p>Tanggal : {{$awal}} - {{$akhir}}</p>
        </center>
        <table style="margin-top:10px;" class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Tanggal Keluar</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $jum=0;
                ?>
                @foreach ($laporan as $b)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$b->Nama_Barang}}</td>
                    <td>{{$b->Jumlah}}</td>
                    <td>{{$b->Satuan}}</td>
                    <td>{{$b->Tanggal_Keluar}}</td>
                    <td>{{$b->Status}}</td>
                    <td>{{$b->Lokasi}}</td>
                </tr>
                <?php
                    $jum = $jum+$b->Jumlah;
                ?>
                @endforeach
            </tbody>
        </table>
        <h5>Total Barang Keluar : {{$jum}}</h5>
    </div>

</body>

</html>
