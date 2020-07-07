<?php

namespace App\Http\Controllers;

use App\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuk = DB::table('barang_masuks')
        ->join('barangs','id_barang','=','barangs.id')
        ->select('barang_masuks.*','barangs.Nama_Barang','barangs.Satuan')
        ->get();
        $barang = DB::table('barangs')->get();
        return view('barang_masuk.index')->with('barang',$barang)->with('barang_masuk',$barang_masuk);
    }

    public function create(Request $request)
    {
        $jumlah_barang = DB::table('barangs')
                    ->select('Jumlah')
                    ->where('id','=',$request->id_barang)
                    ->first();
        $stok = $jumlah_barang->Jumlah + $request->jumlah;
        DB::table('barangs')
                    ->where('id',$request->id_barang)
                    ->update(['Jumlah'=>$stok]);
        $BarangMasuk = new BarangMasuk;
        $BarangMasuk->id_barang = $request->id_barang;
        $BarangMasuk->jumlah = $request->jumlah;
        $BarangMasuk->tanggal_masuk = date("Y-m-d");
        $BarangMasuk->id_admin = $request->id_admin;
        $BarangMasuk->save();
        return back()->with('success','Tambah Barang Masuk Berhasil !');
    }

    public function store(Request $request)
    {
        
    }

    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    public function edit(Request $request)
    {
        $tot_klik = DB::table('barang_masuks')
                    ->select('id_barang','Jumlah')
                    ->where('id','=',$request->id_barang)
                    ->first();
        $tot_barang = DB::table('barangs')
                    ->select('Jumlah')
                    ->where('id', '=', $tot_klik->id_barang)
                    ->first();
        $BarangMasuk = new BarangMasuk;
        $BarangMasuk->jumlah = $request->jumlah;
       
        $tot_skrg = $tot_barang->Jumlah - $tot_klik->Jumlah + $BarangMasuk->jumlah;
     
        DB::table('barangs')
                ->where('id',$tot_klik->id_barang)
                ->update(['jumlah'=>$tot_skrg]);
        DB::table('barang_masuks')
                ->where('id',$request->id_barang)
                ->update(['jumlah'=>$BarangMasuk->jumlah]);
        return back()->with('success','Edit Barang Masuk Berhasil !');;
    }

    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        //
    }

    public function destroy($id)
    {
        $jml_hapus = DB::table('barang_masuks')
                    ->select('id_barang','Jumlah')
                    ->where('id','=',$id)
                    ->first();
        $jml_barang = DB::table('barangs')
                    ->select('Jumlah')
                    ->where('id', '=', $jml_hapus->id_barang)
                    ->first();
        $stok_skrg = $jml_barang->Jumlah-$jml_hapus->Jumlah;
        echo $stok_skrg;
        DB::table('barangs')
                    ->where('id', $jml_hapus->id_barang)
                    ->update(['jumlah' => $stok_skrg]);
        DB::table('barang_masuks')->where('id', '=', $id)->delete();
        return back()->with('success','Hapus Barang Masuk Berhasil !');;;
    }
    public function buatlaporan()
    {
        return view('barang_masuk.bmasuklaporan');
    }

    public function laporan(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $laporan = DB::table('barang_masuks')
            ->join('barangs', 'id_barang', '=', 'barangs.id')
            ->select('barang_masuks.*','barangs.Nama_Barang','barangs.Satuan')
            ->whereBetween('Tanggal_Masuk', array($awal,$akhir))
            ->get();
        // echo $laporan;
        return view('barang_masuk.laporan',['laporan'=>$laporan,'awal'=>$awal,'akhir'=>$akhir]);
    }
    public function cetak_pdf(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $laporan = DB::table('barang_masuks')
            ->join('barangs', 'id_barang', '=', 'barangs.id')
            ->select('barang_masuks.*','barangs.Nama_Barang','barangs.Satuan')
            ->whereBetween('Tanggal_Masuk', array($awal,$akhir))
            ->get();
        $pdf = PDF::loadview('barang_masuk.pdf-laporan',['laporan'=>$laporan,'awal'=>$awal,'akhir'=>$akhir]);
        return $pdf->download('Data_Barang_Masuk.pdf');
    }
}
