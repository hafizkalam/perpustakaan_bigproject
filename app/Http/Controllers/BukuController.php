<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_buku;

class BukuController extends Controller
{
    public function index(){
        $title = 'List Buku';
        // $data = \DB::table('master_buku as b')->join('master_kategori as k','b.kategori','=','k.id')
        // ->select('b.gambar','b.judul','k.nama','b.penulis','b.stocks','b.created_at','b.id','b.status')->get();
 
        $data = Model_buku::get();

        return view('buku.buku_index',compact('title','data'));
    }

    public function kosong(){
        $title = 'List Buku Stock Habis';
        // $data = \DB::table('master_buku as b')->join('master_kategori as k','b.kategori','=','k.id')
        // ->select('b.gambar','b.judul','k.nama','b.penulis','b.stocks','b.created_at','b.id','b.status')
        // ->where('b.stocks','<',1)->get();
        
        $data = Model_buku::where('stocks','<',1)->get();
        // dd($data);
 
        return view('buku.buku_index',compact('title','data'));
    }

    public function nonaktif(){
        $title = 'List Buku Nonaktif';
        // $data = \DB::table('master_buku as b')->join('master_kategori as k','b.kategori','=','k.id')
        // ->select('b.gambar','b.judul','k.nama','b.penulis','b.stocks','b.created_at','b.id','b.status')
        // ->where('b.status','!=',1)->get();
        
        $data = Model_buku::where('stocks','<',1)->get();
        // dd($data);
 
        return view('buku.buku_index',compact('title','data'));
    }

    public function add(){
        $title = 'Tambah Buku';
        $kategori = \DB::table('master_kategori')->get();
 
        return view('buku.buku_add',compact('title','kategori'));
    }
 
    public function store(Request $request){
        $judul = $request->judul;
        $kategori = $request->kategori;
        $penulis = $request->penulis;
        $sinopsis = $request->sinopsis;
        $stocks = $request->stocks;
 
        $file = $request->file('image');
 
        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());
 
        \DB::table('master_buku')->insert([
            'kategori'=>$kategori,
            'judul'=>$judul,
            'penulis'=>$penulis,
            'gambar'=>$file->getClientOriginalName(),
            'sinopsis'=>$sinopsis,
            'stocks'=>$stocks,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        
        \Session::flash('sukses','Data buku berhasil di tambah');

        return redirect('master/buku');
    }

    public function edit($id){
        $title = 'Edit Buku';
        $dt = \DB::table('master_buku')->where('id',$id)->first();
        $kategori = \DB::table('master_kategori')->get();
 
        return view('buku.buku_edit',compact('title','dt','kategori'));
    }

    public function update(Request $request,$id){
        $judul = $request->judul;
        $sinopsis = $request->sinopsis;
        $stocks = $request->stocks;
        $kategori = $request->kategori;
        $penulis = $request->penulis;
 
        $file = $request->file('image');
 
        if($file){
            \DB::table('master_buku')->where('id',$id)->update([
                'kategori'=>$kategori,
                'judul'=>$judul,
                'sinopsis'=>$sinopsis,
                'stocks'=>$stocks,
                'penulis'=>$penulis,
                'gambar'=>$file->getClientOriginalName(),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
 
            //Move Uploaded File
            $destinationPath = 'uploads';
            $file->move($destinationPath,$file->getClientOriginalName());
        }else{
            \DB::table('master_buku')->where('id',$id)->update([
                'kategori'=>$kategori,
                'judul'=>$judul,
                'sinopsis'=>$sinopsis,
                'stocks'=>$stocks,
                'penulis'=>$penulis,
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }
 
        \Session::flash('sukses','Buku berhasil di update');
 
        return redirect('master/buku');
    }

    public function delete($id){
        \DB::table('master_buku')->where('id',$id)->delete();
 
        \Session::flash('sukses','Data buku berhasil dihapus');
        return redirect('master/buku');
    }

    public function status($id){
        $data = \DB::table('master_buku')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == 1){
            \DB::table('master_buku')->where('id',$id)->update([
                'status'=>0
            ]);
        }else{
            \DB::table('master_buku')->where('id',$id)->update([
                'status'=>1
            ]);
        }
        \Session::flash('sukses','Status berhasil di ubah');
 
        return redirect('master/buku');
    }

}
