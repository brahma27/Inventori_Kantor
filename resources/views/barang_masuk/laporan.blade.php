@extends('layout/main') @section('title','Data Barang Masuk') @section('container')
<div style="padding-top: 30px;" class="container-fluid">
    <center>
        <h2>Data Barang Masuk</h2>
        <p>{{$awal}} - {{$akhir}}</p>
    </center>
    <form method="post" action="/pdf-bmasuk">
        @csrf
        <div style="display: none;">
            <input name="awal" type="date" value="{{$awal}}" />
            <input name="akhir" type="date" value="{{$akhir}}" />
        </div>
        <button type="submit" class="btn btn-danger">Print</button><a style="margin-left: 10px;" type="button" href="/buatlap-BMasuk" class="btn btn-secondary">Kembali</a>
    </form>
    <table style="margin-top: 10px;" class="table">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no=1;
                $jum=0;
            ?>
            @foreach ($laporan as $b)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$b->Nama_Barang}}</td>
                <td>{{$b->Jumlah}}</td>
                <td>{{$b->Satuan}}</td>
                <td>{{$b->Tanggal_Masuk}}</td>
            </tr>
            <?php
                $jum = $jum + $b->Jumlah; 
            ?> 
            @endforeach
        </tbody>
    </table>
    <h5>Total Barang Masuk : {{$jum}}</h5>
</div>
@endsection
