<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_peminjaman;
use App\Models\Model_buku;

class PengembalianController extends Controller
{
    public function index(){
        $title = 'Halaman Pengembalian Buku';
        if(\Auth::user()->status == 1){
            $data = Model_peminjaman::whereIn('status',[1,3])->get();
        }else{
            $data = Model_peminjaman::whereIn('status',[1,3])->where('user',\Auth::user()->id)->get();
        }

        return view('pengembalian.index',compact('title','data'));
    }
 
    public function pengembalian($id){
        $dt = Model_peminjaman::find($id);
        $id_buku = $dt->buku;
 
        $buku = Model_buku::find($id_buku);
 
        $now = $buku->stocks;
        $stocks_pengembalian = $now + 1;
 
        Model_peminjaman::where('id',$id)->update([
            'status'=>3
        ]);
 
        Model_buku::where('id',$id_buku)->update([
            'stocks'=>$stocks_pengembalian
        ]);
 
        return redirect('pengembalian-buku');
    }
}
