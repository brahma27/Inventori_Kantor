<?php

namespace App\Http\Controllers;

use App\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Session;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barang_keluar = DB::table('barangs')->get();
        $barang = DB::table('barangs')
        ->join('barang_keluars','id_barang','=','barangs.id')
        ->get();
        return view('barang_keluar.barang_keluar')->with('barang',$barang)->with('barang_keluar',$barang_keluar);
    }
    public function create(Request $request)
    {
        $jumlah_barang = DB::table('barangs')
                        ->select('Jumlah')
                        ->where('id','=',$request->id_barang)
                        ->first();
        $jumlah = $request->jumlah_keluar;
        $stok = $jumlah_barang->Jumlah-$jumlah;
        DB::table('barangs')
            ->where('id',$request->id_barang)
            ->update(['Jumlah'=>$stok]);
        // echo $jumlah_barang->Jumlah-$jumlah_keluar;
        $BarangKeluar = new BarangKeluar;
        $BarangKeluar->Jumlah = $jumlah;
        $BarangKeluar->Tanggal_Keluar = date("Y-m-d");
        $BarangKeluar->Status = $request->status;
        $BarangKeluar->Lokasi = $request->lokasi;
        $BarangKeluar->id_barang = $request->id_barang;
        $BarangKeluar->save();
        return back()->with('success','Tambah Barang Keluar Berhasil !');
    }
    public function store(Request $request)
    {
        //
    }
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }
    public function edit(Request $request)
    {
        $tot_klik = DB::table('barang_keluars')
                    ->select('id_barang','Jumlah')
                    ->where('id','=',$request->id_barang)
                    ->first();
        // echo $tot_klik->Jumlah;
        $tot_barang = DB::table('barangs')
                    ->select('Jumlah')
                    ->where('id', '=', $tot_klik->id_barang)
                    ->first();
        // echo $tot_barang->Jumlah;
        $BarangKeluar = new BarangKeluar;
        $BarangKeluar->Jumlah = $request->jumlah_keluar;
        $BarangKeluar->Lokasi = $request->lokasi;
        $BarangKeluar->Tanggal_Keluar = date("Y-m-d");
        $BarangKeluar->Status = $request->status;
        $tot_skrg = $tot_barang->Jumlah + $tot_klik->Jumlah - $BarangKeluar->Jumlah;
        // echo $tot_skrg;
        DB::table('barangs')
            ->where('id',$tot_klik->id_barang)
            ->update(['Jumlah'=>$tot_skrg]);
        DB::table('barang_keluars')
            ->where('id',$request->id_barang)
            ->update(['Jumlah'=>$BarangKeluar->Jumlah]);
        DB::table('barang_keluars')
            ->where('id',$request->id_barang)
            ->update(['Lokasi'=> $BarangKeluar->Lokasi]);
        DB::table('barang_keluars')
            ->where('id',$request->id_barang)
            ->update(['Status'=> $BarangKeluar->Status]);
        return back()->with('success','Edit Barang Keluar Berhasil !');
    }
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }
    public function destroy($id)
    {
        DB::table('barang_keluars')->where('id', '=', $id)->delete();
        return back()->with('success','Berhasil Menghapus Barang Keluar!');
    }
    public function buatlaporan()
    {
        return view("barang_keluar.bkeluarlaporan");
    }
    public function laporan(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $laporan = DB::table('barangs')
            ->join('barang_keluars', 'id_barang', '=', 'barangs.id')
            ->select('barang_keluars.*','barangs.Nama_Barang','barangs.Satuan')
            ->whereBetween('Tanggal_Keluar', array($awal,$akhir))
            ->get();
        return view('barang_keluar.laporan',['laporan'=>$laporan,'awal'=>$awal,'akhir'=>$akhir]);
    }
    public function cetak_pdf(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;

        $laporan = DB::table('barangs')
            ->join('barang_keluars', 'id_barang', '=', 'barangs.id')
            ->select('barang_keluars.*','barangs.Nama_Barang','barangs.Satuan')
            ->whereBetween('Tanggal_Keluar', array($awal,$akhir))
            ->get();
        $pdf = PDF::loadview('barang_keluar.pdf-laporan',['laporan'=>$laporan,'awal'=>$awal,'akhir'=>$akhir]);
        return $pdf->download('Data_Barang_Keluar.pdf');
    }
}
