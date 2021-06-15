<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_peminjaman;

class PeminjamanController extends Controller {

    public function index(){
        $title = 'Halaman Peminjaman Buku All';

        if(\Auth::user()->status ==1){
            $data = Model_peminjaman::get();
        }else{
            $data = Model_peminjaman::where('user',\Auth::user()->id)->get();
        }
 
        return view('peminjaman.index',compact('title','data'));
    }

    public function store($id){
        $cek = \DB::table('master_buku')
        ->where('id',$id)
        ->where('stocks','>',0)
        ->where('status',1)->count();

        if($cek > 0){
            \DB::table('peminjaman')->insert([
                'buku'=>$id,
                'user'=>\Auth::user()->id,
                'created_at'=>date('Y-m-d H:i:s')
            ]);
    
            $buku = \DB::table('master_buku')->where('id',$id)->first();
            $qty_now = $buku->stocks;
            $qty_new = $qty_now - 1;

            \DB::table('master_buku')->where('id',$id)->update([
                'stocks'=>$qty_new
            ]);

            \Session::flash('sukses','Buku Berhasil Dipinjam');
    
                return redirect('master/buku');
        }else{
            \Session::flash('gagal','Buku Sudah Habis atau Tidak Aktif');
 
            return redirect('master/buku');
        }
    }

    public function setujui($id){
        Model_peminjaman::where('id',$id)->update(['status'=>1]);
 
        return redirect('pinjam-buku');
    }

    public function tolak($id){
        Model_peminjaman::where('id',$id)->update(['status'=>2]);
 
        return redirect('pinjam-buku');
    }

}