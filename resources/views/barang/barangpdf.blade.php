<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div style="padding-top:30px;" class="container-fluid">
        <center><h2>Data Barang</h2></center>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Lokasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $jum = 0;
                ?>
                @foreach($barang as $br)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $br->Nama_Barang }}</td>
                    <td>{{ $br->Nama_Kategori}}</td>
                    <td>{{ $br->Jumlah }}</td>
                    <td>{{ $br->Satuan }}</td>
                    <td>{{ $br->Status }}</td>
                    <td>{{ $br->Lokasi }}</td>
                </tr>
                <?php
                    $jum = $jum+$br->Jumlah;
                ?>
                @endforeach
            </tbody>
        </table>
        <h3>Total Barang : {{$jum}}</h3>
    </div>

</body>

</html>
