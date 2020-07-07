@extends('layout/main') 
@section('title','Data Barang Keluar') 
@section('container')
<div style="padding-top: 30px;" class="container-fluid">
    <center>
        <h2>Data Barang Keluar</h2>
        <p>{{$awal}} - {{$akhir}}</p>
    </center>
    <form method="post" action="/pdf-bkeluar">
        @csrf
        <div style="display: none;">
            <input name="awal" type="date" value="{{$awal}}" />
            <input name="akhir" type="date" value="{{$akhir}}" />
        </div>
        <button type="submit" class="btn btn-danger">Print</button>
        <a style="margin-left: 10px;" type="button" href="/buatlap-BKeluar" class="btn btn-secondary">Kembali</a>
    </form>
    <table style="margin-top: 10px;" class="table">
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
                $jum = $jum+$b->Jumlah; ?> @endforeach
        </tbody>
    </table>
    <h5>Total Barang Keluar : {{$jum}}</h5>
</div>
@endsection
