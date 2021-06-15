<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_peminjaman;
use App\User;

class LaporanController extends Controller
{
    public function index(){
        $title = 'List Laporan';
        $data = Model_peminjaman::get();
        $users = User::whereNull('status')->get();
        
        // echo"<pre>";
        // print_r($data);
        // exit();
        // dd($data);
        return view('laporan.index',compact('title','data','users'));
    }

    public function periode(Request $request){
        $users = User::whereNull('status')->get();
 
        $tanggal_awal = date('Y-m-d',strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-d',strtotime($request->tanggal_akhir));
        $user = $request->user;
 
        $title = "List Laporan Dari Tanggal $tanggal_awal Sampai Tanggal $tanggal_akhir";
 
        if($user == 'all'){
            $data = Model_peminjaman::where('created_at','>=',$tanggal_awal.' 00:00:00')
            ->where('created_at','<=',$tanggal_akhir. '23:59:59')->get();
        }else{
            $data = Model_peminjaman::where('created_at','>=',$tanggal_awal.' 00:00:00')
            ->where('created_at','<=',$tanggal_akhir. '23:59:59')->where('user',$user)->get();
        }
 
       
        // dd($data);
        return view('laporan.index',compact('title','data','users'));
    }

    public function cetakLaporan(){
        $title = 'Cetak Laporan';
        $data = Model_peminjaman::get();
        
        return view('laporan.cetak_laporan',compact('title','data'));
    }
}
