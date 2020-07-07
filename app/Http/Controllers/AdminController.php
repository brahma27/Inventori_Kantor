<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index()
    {
        if(!session()->has('username')){
            Session::flash('message', 'Login Terlebih Dahulu');
            return view('login');
        }
        return view('registrasi.tambahakun');
    }

   
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $cek = $request->username;
        $temp = DB::table('admins')->select('Username')->where('Username',$cek)->value('Username');
        if ($temp==$cek) {
            return back()->with('warning','Username Admin Sudah Ada !');
        }else{
            $admin = new admin;
            $admin->Username = $request->username;
            $admin->Password = bcrypt($request->password);
            $admin->save();
            return back()->with('success','Berhasil Registrasi Akun Admin !');
        }
    }
    public function show(Admin $admin)
    {
        //
    }
    public function edit(Admin $admin)
    {
        //
    }
    public function update(Request $request, Admin $admin)
    {
        //
    }
    public function destroy(Admin $admin)
    {
        //
    }
    public function edit_Admin(){
        return view("registrasi.editakun");
    }
    public function edit_akun_admin(Request $request){
        $cek_akun = DB::table("admins")
                    ->where('id','=',$request->id)
                    ->get();
        $Admin =  new Admin;
        $temp = $request->new_password;
        $temp1 = $request->confirm_password;
        $masuk =  bcrypt($request->confirm_password);
        if($temp != $temp1){
            // echo "ini tidak sama";
            return back()->with('warning','Password Yang dimasukan Tidak Sama !');
        }else{
            DB::table('admins')
                ->where('id', $request->id)
                ->update(['Password' => $masuk]);
            return back()->with('success','Edit Akun Admin Berhasil !');
        }
    }
       
}
