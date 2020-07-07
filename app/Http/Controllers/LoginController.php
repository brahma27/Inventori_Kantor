<?php

namespace App\Http\Controllers;

use App\Admin;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function cek_login(Request $request){
        $Username = $request->username;
        $Password = $request->password;

        $data =  Admin::where('Username',$Username)->first();
        echo "<script>console.log('Debug Objects: " . $data . "' );</script>";
        if($data){//cek username tersedia apa tidak
            if(Hash::check($Password,$data->Password)){
                Session::put('id',$data->id);
                Session::put('username',$data->Username);
                return redirect('kategori');
            }else{
                return back()->with('warning','Username dan Password Yang Di Masukan Salah !');
            }
        }else{
            return back()->with('warning','Username dan Password Yang Di Masukan Salah !');
        }
    }
    public function logout(){
        Session::flush();
        Session::flash('message', 'Anda Sudah Logout !');
        return redirect('/');
    }
    
}
