<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
  
    public function index()
    {
        if (!session()->has('username')) {
            Session::flash('message', 'Login Terlebih Dahulu');
            return view('login');
        }
        $kategori = DB::table('kategoris')->get();
        return view('barang.kategori')->with('kategori',$kategori);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $kategori = new kategori;
        $kategori->Nama_Kategori=$request->namakategori;
        $kategori->save();
        // Session::flash('message', 'Kategori Berhasil Ditambah');

        return back();
    }

    public function show(Kategori $kategori)
    {
        //
    }

    public function edit(Request $request)
    {
        DB::table('kategoris')
            ->where('id', $request->id_kategori)
            ->update(['Nama_Kategori' => $request->namakategori]);
        return back()->with('success','Kategori Berhasil Diedit !');
    }

    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    public function destroy(Kategori $kategori)
    {
        //
    }
}
