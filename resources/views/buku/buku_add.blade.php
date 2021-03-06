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
                <form role="form" method="post" action="{{ url('master/buku/add') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                        <label for="exampleInputEmail1">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" id="exampleInputEmail1" placeholder="Judul Buku">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Penulis Buku</label>
                            <input type="text" name="penulis" class="form-control" id="exampleInputEmail1" placeholder="Judul Buku">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Stocks Buku</label>
                            <input type="number" name="stocks" class="form-control" id="exampleInputEmail1" placeholder="Stocks Buku">
                        </div>
 
                        <div class="form-group">
                            <select class="form-control select2" name="kategori">
                                <option selected="" disabled="">Pilih Kategori</option>
                                @foreach($kategori as $kt)
                                <option value="{{ $kt->id }}">{{ $kt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Sinopsis Buku</label>
                            <textarea class="form-control summernote" name="sinopsis"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" name="image" id="exampleInputFile">
 
                            <p class="help-block">Upload Gambar</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
 
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
@endsection