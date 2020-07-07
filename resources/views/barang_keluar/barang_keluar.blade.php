@extends('layout/main')
@section('title','Barang Keluar')
@section('container')
<center>
  <h2 style="margin-top:40px;">Data Barang Keluar</h2>
</center>
@if(session('success'))
    @include('sweetalert::alert')
@endif
<div style="border-top:solid 1px rgba(0, 0, 0, .5);padding-top:40px;" class="container-fluid">          
  <div class="row">
    <div class="col-12 mt-4">
      <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tanggal Keluar</th>
            <th>Status</th>
            <th>Lokasi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($barang as $ba)
          <tr>
            <td>{{$ba->Nama_Barang}}</td>
            <td>{{$ba->Jumlah}}</td>
            <td>{{$ba->Satuan}}</td>
            <td>{{$ba->Tanggal_Keluar}}</td>
            <td>{{$ba->Status}}</td>
            <td>{{$ba->Lokasi}}</td>
            <span>
              <td>
                <button class="btn btn-secondary mb-2" id="edit" value="#" data-toggle="modal" data-target=".modal{{ $ba->id }}" style="padding-left: 22px; padding-right: 22px;">Edit</button>
                <a href="/deleteBKeluar/{{ $ba->id }}">
                  <button class="btn btn-danger mb-2" onclick="return confirm('Apakah anda yakin akan menghapus barang keluar ini?');">Delete</button>
                </a>
              </td>
            </span>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="mt-4 mb-4">
    <button type="button" class="btn" data-toggle="modal" data-target="#tambahmodal" style="background-color: #3b8686;">Tambah</button>
    <a href='/buatlap-BKeluar'><button type="button" class="btn btn-success">Buat Laporan Data Keluar</button></a>
  </div>
</div>

<!-- Modal Barang Keluar -->
<div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="text-align: center; padding-left: 150px;">Barang Keluar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right: 1px;">x</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <form action="/addBKeluar" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label style="float: left;">Nama Barang</label>
                                <select class="custom-select" id="nama_barang" name="id_barang" required>
                                    <option selected disabled>--Nama Barang--</option>
                                    @foreach ($barang_keluar as $br)
                                    @if($br->Jumlah>0)
                                        <option value="{{$br->id}}">{{$br->Nama_Barang}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="float: left;">Jumlah Tersedia</label>
                                <input min="1" type="text" class="form-control" id="jumlah_tersedia" placeholder="Jumlah Tersedia" name="jumlah_tersedia" aria-describedby="basic-addon1" readonly/>
                            </div>
                            <div class="form-group">
                                <label style="float: left;">Jumlah Keluar</label>
                                <input min="1" type="text" class="form-control" id="jumlah_keluar" placeholder="jumlah Keluar" name="jumlah_keluar" aria-describedby="basic-addon1"/>
                            </div>
                            <div class="form-group">
                                <label style="float: left;">Satuan</label>
                                <input min="1" type="text" class="form-control" id="satuan" placeholder="Satuan" name="satuan" aria-describedby="basic-addon1" readonly />
                            </div>
                            <div class="form-group">
                                <label style="float: left;">Status</label>
                                <select class="custom-select" id="status" name="status" required>
                                    <option selected disabled>--Pilih Status--</option>
                                    <option value="Dipinjam">Dipinjam</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Hilang">Hilang</option>
                                </select>
                            </div>
                            <div class="form-group" style="display: none;">
                                <input min="1" type="text" class="form-control" id="coba" placeholder="coba" name="satuan" aria-describedby="basic-addon1"/>
                            </div>
                            <div class="form-group">
                                <label style="float: left;">Lokasi</label>
                                <input min="1" type="text" class="form-control" id="lokasi" placeholder="Lokasi" name="lokasi" aria-describedby="basic-addon1"/>
                            </div> 
                        </div>
                    </div>
                    <p style="color: red; float: left;">*Barang yang stocknya habis namanya tidak akan muncul pada list nama barang</p>
                    <button class="btn btn-success" type="submit" style="width: 100px; height: 50px; margin-right: 20px;">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Barang Keluar-->
@foreach ($barang as $br)
<div class="modal fade modal{{ $br->id }}" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="text-align: center; padding-left: 120px;">Edit Barang Keluar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right: 1px;">x</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <form action="/editBKeluar" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input style="display: none;" type="text" id="id_barang" name="id_barang" class="form-control" placeholder="" aria-describedby="basic-addon1" value="{{ $br->id }}" readonly/>
                                <label style="float: left;">Nama Barang</label>
                                <input type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="{{$br->Nama_Barang}}" value="{{$br->Nama_Barang}}" aria-describedby="basic-addon1" readonly />
                            </div>
                            <div class="form-group">
                                <label style="float: left;">Jumlah Keluar</label>
                                <input min="1" type="text" class="form-control" id="jumlah_keluar" placeholder="{{$br->Jumlah}}" name="jumlah_keluar" aria-describedby="basic-addon1" required/>
                            </div>
                            <div class="form-group">
                                <label style="float: left;">Satuan</label>
                                <input min="1" type="text" class="form-control" id="satuan" placeholder="{{$br->Satuan}}" name="satuan" aria-describedby="basic-addon1" value="{{$br->Satuan}}" readonly />
                            </div>
                            <div class="form-group">
                                <label style="float: left;">Status</label>
                                <select class="custom-select" id="status" name="status" required>
                                    <option selected disabled>{{$br->Status}}</option>
                                    <option value="Dipinjam">Dipinjam</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Hilang">Hilang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="float: left;">Lokasi</label>
                                <input min="1" type="text" class="form-control" id="lokasi" placeholder="{{$br->Lokasi}}" name="lokasi" aria-describedby="basic-addon1" required />
                            </div> 
                        </div>
                    </div>
                    <button class="btn btn-secondary" type="submit" style="width: 100px; height: 50px; margin-right: 20px;">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
  $(document).ready(function () {
      $("#nama_barang").change(function(){
          $idb = $("#nama_barang").val();
          @foreach ($barang_keluar as $br)
          if({{$br->id}} == $idb){
              $("#satuan").val("{{$br->Satuan}}");
              $("#jumlah_tersedia").val("{{$br->Jumlah}}");
              $('#coba').val("{{$br->Jumlah}}")
 
          }           
          @endforeach
      });
      $('#jumlah_keluar').keyup(function () {
          $total = $('#coba').val() - $('#jumlah_keluar').val();
          $cek = $('#jumlah_keluar').val()
          // $('#coba').val($total)
          if($total<0){
            alert('Melebihi Jumlah Yang Tersedia !');
            $('#jumlah_tersedia').val($('#coba').val())
            $('#jumlah_keluar').val('')
          }else if($cek<0){
            alert('Masukan Bilangan Positive !')
            $('#jumlah_tersedia').val($('#coba').val())
            $('#jumlah_keluar').val('')
          }else{
            $('#jumlah_tersedia').val($total)
          }
      });
      $("#barang_keluar").css({ "background-color": "#0b486b", "color": "white", "border-right":"solid 4px #000000"});
      });
</script>
</html>
@endsection
