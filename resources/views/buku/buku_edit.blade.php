@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <p>
                <a href="javascript:history.back()" class="btn btn-sm btn-flat btn-primary">Kembali</a>
            </p>
        <div class="box box-warning">
           
            <div class="box-header">
                <h4>{{ $title }}</h4>
            </div>
            <div class="box-body">
                <form role="form" method="post" action="{{ url('master/buku/'.$dt->id) }}" 
                enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group">
                        <label for="exampleInputEmail1">Judul Buku</label>
                            <input type="text" name="judul" value="{{ $dt->judul }}" 
                            class="form-control" id="exampleInputEmail1" placeholder="Judul Buku">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Penulis Buku</label>
                            <input type="text" name="penulis" value="{{ $dt->penulis }}" 
                            class="form-control" id="exampleInputEmail1" placeholder="Judul Buku">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilih Kategori</label>
                            <select class="form-control select2" name="kategori">
                                <option selected="" disabled="">Pilih Kategori</option>
                                @foreach($kategori as $kt)
                                <option value="{{ $kt->id }}" {{ ($dt->kategori == $kt->id) 
                                ? 'selected' : '' }}>{{ $kt->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Sinopsis</label>
                            <textarea class="form-control summernote" name="sinopsis">{{ $dt->sinopsis }}</textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Stocks Buku</label>
                            <input type="number" name="stocks" value="{{ $dt->stocks }}" 
                            class="form-control" id="exampleInputEmail1" placeholder="Stocks Buku">
                        </div>
 
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" name="image" id="exampleInputFile">
 
                            <p class="help-block">Upload Gambar</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
 
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
@endsection