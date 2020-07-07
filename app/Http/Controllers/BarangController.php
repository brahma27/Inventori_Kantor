<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class BarangController extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategoris')->get();

        $barang = DB::table('kategoris')
                ->join('barangs','id_kategori','=','kategoris.id')
                ->get();
            return view('barang.daftarbarang')->with('barang',$barang)->with('kategori',$kategori);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $temp = $request->namabarang;
        $cek_nama = DB::table('barangs')
                    ->select('Nama_Barang')
                    ->where('Nama_Barang','=',$temp)
                    ->value('Nama_Barang');
        if($temp != $cek_nama){
            $barang = new barang;
            $barang->Nama_Barang=$request->namabarang;
            $barang->Jumlah=$request->jumlahbarang;
            $barang->Satuan=$request->satuanbarang;
            $barang->Lokasi=$request->lokasibarang;
            $barang->Status=$request->statusbarang;
            $barang->id_kategori=$request->id_kategori;
            $barang->save();
            return back()->with('success','Barang Berhasil Ditambah !');
        }else{
            return back()->with('warning','Nama Barang Sudah Ada !');
        }
        
    }

    public function show(Barang $barang)
    {
        //
    }

    public function edit(Request $request)
    {
        DB::table('barangs')
        ->where('id', $request->id_barang)
        ->update(['Nama_Barang' => $request->namabarang]);

        DB::table('barangs')
        ->where('id', $request->id_barang)
        ->update(['Satuan' => $request->satuanbarang]);

        DB::table('barangs')
        ->where('id', $request->id_barang)
        ->update(['Lokasi' => $request->lokasibarang]);

        DB::table('barangs')
        ->where('id', $request->id_barang)
        ->update(['Status' => $request->statusbarang]);

        return back()->with('success','Barang Berhasil Diedit !');;
    }

    public function update(Request $request, Barang $barang)
    {
        //
    }
    public function destroy($id)
    {
        $cek_tot =  DB::table("barangs")
                    ->select('Jumlah')
                    ->where('id','=',$id)
                    ->value('Jumlah');
        if($cek_tot==0){
            DB::table('barangs')->where('id', '=', $id)->delete();
            return back()->with('success','Barang Berhasil Dihapus !');
        }else{
            return back()->with('warning','Barang tidak bisa dihapus, bila Stok Masih Tersedia !');
        }
    }
    public function cetak_pdf()
    {
        $barang = DB::table('kategoris')
            ->join('barangs', 'id_kategori', '=', 'kategoris.id')
            ->get();
        $pdf = PDF::loadview('barang.barangpdf',['barang'=>$barang]);
        return $pdf->download('Daftar_Barang.pdf');
    }
}
