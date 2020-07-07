@extends('layout/main')

@section('title','Barang Masuk')

@section('container')

<center>
  <h2 style="margin-top:40px;">Data Barang Masuk</h2>
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
            <th>Tanggal Masuk</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($barang_masuk as $b)
          <tr>
            <td>{{$b->Nama_Barang}}</td>
            <td>{{$b->Jumlah}}</td>
            <td>{{$b->Satuan}}</td>
            <td>{{$b->Tanggal_Masuk}}</td>
            <span>
              <td>
                <button class="btn btn-secondary mb-2" id="edit" value="{{$b->id}}" data-toggle="modal" data-target=".modal{{ $b->id }} " style="padding-left: 22px; padding-right: 22px;">Edit</button>
                <a href="/deleteBMasuk/{{ $b->id }}">
                  <button class="btn btn-danger mb-2" onclick="return confirm('Apakah anda yakin akan menghapus barang masuk ini?');">Delete</button>
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
    <a href='/buatlap-BMasuk'><button type="button" class="btn btn-success">Buat Laporan Data Masuk</button></a>
  </div>
</div>

<!-- Modal Barang Masuk -->
<div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="text-align: center; padding-left: 150px;">Barang Masuk</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right: 1px;">x</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <form action="/addBMasuk" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <select class="custom-select" id="nama_barang" name="id_barang" required>
                                    <option selected disabled>--Nama Barang--</option>
                                      @foreach ($barang as $br)
                                      <option value="{{$br->id}}">{{$br->Nama_Barang}}</option>
                                      @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input min="1" type="text" class="form-control" id="jumlah" placeholder="jumlah" name="jumlah" aria-describedby="basic-addon1"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="satuan" placeholder="Satuan"readonly/>
                            </div>
                            <div style="display:none" class="form-group">
                                <input min="1" type="text" class="form-control" id="id_admin" placeholder="id_admin" name="id_admin" value="{{ Session::get('id') }}" />
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit" style="width: 100px; height: 50px; margin-right: 20px;">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($barang_masuk as $b)
<div class="modal fade modal{{ $b->id }}" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="text-align: center; padding-left: 120px;">Edit Barang Masuk</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right: 1px;">x</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <form action="/editBMasuk" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input style="display: none;" type="text" id="id_barang" name="id_barang" class="form-control" placeholder="{{$b->Nama_Barang}}" aria-describedby="basic-addon1" value="{{$b->id}}" readonly/>
                                <input type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="{{$b->Nama_Barang}}" aria-describedby="basic-addon1" readonly />
                            </div>
                            <div class="form-group">
                                <input min="1" type="text" class="form-control" id="jumlah_edit" placeholder="{{$b->Jumlah}}" name="jumlah" aria-describedby="basic-addon1" required="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="satuan" placeholder="{{$b->Satuan}}" value="{{$b->Satuan}}" readonly/>
                            </div>
                            <div style="display:none;" class="form-group">
                                <input min="1" type="text" class="form-control" id="id_admin" placeholder="id_admin" name="id_admin" value="{{ Session::get('id') }}" readonly="" />
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
          @foreach ($barang as $br)
          if({{$br->id}} == $idb){
              $("#satuan").val("{{$br->Satuan}}");
          }           
          @endforeach
      });
      $('#jumlah').keyup(function () {
          $total = $('#jumlah').val();
          if($total<0){
            alert('Ini bilangan negative, Masukan bilangan positive !');
            $('#jumlah').val('')
          }else{
            $('#jumlah').val($total)
          }
      });
      $('#jumlah_edit').keyup(function () {
          $total = $('#jumlah_edit').val();
          if($total<0){
            alert('Ini bilangan negative, Masukan bilangan positive !');
            $('#jumlah_edit').val('')
          }else{
            $('#jumlah_edit').val($total)
          }
      });
      $("#barang_masuk").css({ "background-color": "#0b486b", "color": "white", "border-right":"solid 4px #000000"});
      });
</script>
</html>
@endsection
