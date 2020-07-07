@extends('layout/main') 
@section('title','Kategori barang') 
@section('container')
<center>
    <h2 style="margin-top: 40px;">Kategori Barang</h2>
</center>
@if(session('success'))
    @include('sweetalert::alert')
@endif
<div style="border-top: solid 1px rgba(0, 0, 0, 0.5); padding-top: 40px;" class="container-fluid">
    <div class="content-table" style="margin: 5%; margin-top: 0%;">
        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID Kategori</th>
                    <th scope="col">Nama Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $ktr)
                <tr>
                    <td>{{$ktr->id}}</td>
                    <td>{{$ktr->Nama_Kategori}}</td>
                    <td>
                        <button id="butEdit" style="margin-left: 150px;" data-target=".modal{{$ktr->id}}" value="{{ $ktr->id }}" data-toggle="modal" class="btn btn-secondary">Edit</button>
                    </td>
                        <div class="modal fade modal{{$ktr->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="padding: 20px; margin-left: 50px;">
                                    <h3>Edit Kategori</h3>
                                    <!-- form untuk edit kategori -->
                                    <form method="POST" action="/edit_kategori">
                                        @csrf
                                        <div class="form-group">
                                            <label for="namakategori">Nama Kategori</label>
                                            <input type="text" class="form-control" name="namakategori" id="namakategori" aria-describedby="emailHelp" />
                                            <input style="display: none;" type="text" class="form-control" name="id_kategori" id="id_kategori" aria-describedby="emailHelp" value={{$ktr->id}} />
                                        </div>
                                        <br />
                                        <br />
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <button type="submit" class="btn btn-dark" style="width: 100px; height: 50px; margin-right: 100px; margin-left: 40px; margin-top: -40px;">Edit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background-color: #3b8686;color: white;">Tambah Kategori</button>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="padding: 20px;">
                    <center>
                        <h2>Tambah Kategori</h2>
                    </center>
                    <form method="POST" action="/tambah_kategori">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Kategori</label>
                            <input type="text" class="form-control" name="namakategori" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama Kategori" />
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-8">
                                <button type="submit" class="btn btn-success" style="width: 100px; height: 40px; margin-left: 20px;">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
           $("#daftar_kategori").css({ "background-color": "#0b486b", "color": "white", "border-right":"solid 4px #000000"});
        });
    </script>
    @endsection
</div>
