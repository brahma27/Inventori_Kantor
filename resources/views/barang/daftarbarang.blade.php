@extends('layout/main')
@section('title','Daftar Barang')
@section('container')
<center>
    <h2 style="margin-top: 40px;">Daftar Barang</h2>
</center>
@if(session('success'))
    @include('sweetalert::alert')
@endif
@if(session('warning'))
    @include('sweetalert::alert')
@endif
<div style="border-top: solid 1px rgba(0, 0, 0, 0.5); padding-top: 40px;">
    <div class="content-table" style="margin: 2%; margin-top: 0%;">
        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barang as $brg)
                <tr>
                    <td>{{$brg->Nama_Barang}}</td>
                    <td>{{$brg->Nama_Kategori}}</td>
                    <td>{{$brg->Jumlah}}</td>
                    <td>{{$brg->Satuan}}</td>
                    <td>{{$brg->Lokasi}}</td>
                    <td>{{$brg->Status}}</td>
                    <td>
                        <!-- delete barang -->
                        <a  href="deleteBarang/{{ $brg->id }}">
                            <button class="btn btn-danger mb-2"
                                onclick="return confirm('Apakah Anda yakin Ingin Menghapus Barang Ini?');">Delete</button></a>
                        <!-- edit -->
                        <button id="butEdit" style="padding-left: 22px;padding-right: 22px;" data-target=".modal{{$brg->id}}" value="{{ $brg->id }}"
                            data-toggle="modal" class="btn btn-secondary mb-2">Edit</button>
                    </td>
                    <div class="modal fade modal{{$brg->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="padding: 20px; margin-left: 50px;">
                                <h3>Edit Barang</h3>
                                <!-- form untuk edit barang-->
                                <form method="POST" action="/edit_barang">
                                    @csrf
                                    <div class="form-group">
                                        <label for="namabarang">Nama Barang</label>
                                        <input type="text" class="form-control"name="namabarang" id="namabarang"
                                        value="{{$brg->Nama_Barang}}">
                                        <input style="display: none;" type="text" class="form-control"
                                        name="id_barang" id="id_barang"
                                        value={{$brg->id}} >
                                    </div>
                                    <div class="form-group">
                                        <label for="kategoribarang">Kategori</label>
                                        <input type="text" class="form-control"name="kategoribarang" id="kategoribarang" value="{{$brg->Nama_Kategori}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlahbarang">Jumlah</label>
                                        <input type="text" class="form-control"name="jumlahbarang" id="jumlahbarang"
                                        value="{{$brg->Jumlah}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="satuanbarang">Satuan</label>
                                        <input type="text" class="form-control"name="satuanbarang" id="satuanbarang"
                                        value="{{$brg->Satuan}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="lokasibarang">Lokasi</label>
                                        <input type="text" class="form-control"name="lokasibarang" id="lokasibarang"
                                        value="{{$brg->Lokasi}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="statusbarang">Status</label>
                                        <input type="text" class="form-control"name="statusbarang" id="statusbarang"
                                        value="{{$brg->Status}}">
                                    </div>
                                    <br />
                                    <br />
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <button type="submit" class="btn btn-dark"
                                                style="width: 100px; height: 50px; margin-right: 100px; margin-left: 40px; margin-top: -40px;">Edit</button>
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

        <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg"
            style="background-color: #3b8686;color: white;">Tambah Barang</button>
        <a href="/pdf-barang"><button type="button" class="btn btn-success">Print</button></a>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="padding: 20px;">
                    <center>
                        <h2>Tambah Barang</h2>
                    </center>
                    <form method="POST" action="/tambah_barang">
                        @csrf
                        <select name="id_kategori" id="idkategori" style="margin-bottom:20px;" class="custom-select"
                            id="idkategori">
                            <option selected disable>Nama Kategori</option>
                            @foreach( $kategori as $ktr )
                            <option value="{{ $ktr->id }}">
                                {{ $ktr->Nama_Kategori }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="form-group" style="display: none;">
                            <input type="text" class="form-control" name=id id="id" placeholder="Masukkan Nama Barang">
                        </div> -->
                        <div class="form-group">
                            <label for="namabarang">Nama Barang</label>
                            <input type="text" class="form-control" name=namabarang id="namabarang" placeholder="Masukkan Nama Barang">
                        </div>
                        <div class="form-group">
                            <label for="Jumlah">Jumlah</label>
                            <input type="text" class="form-control" name=jumlahbarang id="jumlahbarang" placeholder="0" value="0" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="Satuan">Satuan</label>
                            <input type="text" class="form-control" name=satuanbarang id="satuanbarang"
                            placeholder="Masukkan Satuan Barang">
                        </div>
                        <div class="form-group">
                            <label for="Lokasi">Lokasi</label>
                            <input type="text" class="form-control" name=lokasibarang id="lokasibarang"
                            placeholder="Masukkan Lokasi Barang">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" name=statusbarang id="statusbarang"
                            placeholder="Masukkan Status Barang">
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-8">
                                <button type="submit" class="btn btn-success"
                                    style="width: 100px; height: 40px; margin-left: 350px;">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#daftar_barang").css({ "background-color": "#0b486b", "color": "white", "border-right":"solid 4px #000000"});
        });
    </script>

    @endsection
</div>
