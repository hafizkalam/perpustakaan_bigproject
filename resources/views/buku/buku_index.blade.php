@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <p>
            <button class="btn btn-flat btn-sm btn-warning btn-refresh">
            <i class="fa fa-refresh"></i> Refresh</button>

            @if(\Auth::user()->status == 1)
            <a href="{{ url('master/buku/add') }}" class="btn btn-flat btn-sm btn-success">
            <i class="fa fa-plus"></i> Tambah Buku</a>
            @endif

            <a href="{{ url('master/buku/') }}" class="btn btn-flat btn-sm btn-primary">Semua Buku</a>

            <a href="{{ url('master/buku/kosong') }}" class="btn btn-flat btn-sm btn-danger">Buku Stocks Habis</a>

            <a href="{{ url('master/buku/nonaktif') }}" class="btn btn-flat btn-sm btn-info">Buku Nonaktif</a>
        </p>
        <div class="box box-warning">
            <div class="box-header">
                <h4>{{ $title }}</h4>
            </div>
            <div class="box-body">
                <table class="table table-hover myTable">
                    <thead>
                        <tr>
                            <th>#</th>

                            @if(\Auth::user()->status ==1)
                            <th>Status</th>
                            @endif

                            <th>Pinjam</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Stocks</th>
                            <th>Status</th>
                            <th>Created At</th>

                            @if(\Auth::user()->status == 1)
                            <th>Action</th>
                            @endif
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $e=>$dt)
                        <tr>
                            <td>{{ $e+1 }}</td>

                            @if(\Auth::user()->status == 1)
                            <td>
                                @if($dt->status == 1)
                                    <a href="{{ url('master/buku/status/'.$dt->id) }}" 
                                    class="btn btn-sm btn-danger">Non-Aktifkan</a>
                                @else
                                    <a href="{{ url('master/buku/status/'.$dt->id) }}" 
                                    class="btn btn-sm btn-success">Aktifkan</a>
                                @endif
                            </td>
                            @endif

                            <td>
                            <a href="{{ url('pinjam-buku/'.$dt->id) }}"
                             class="btn btn-flat btn-sm btn-primary">Pinjam Buku</a>
                            </td>
                            <td>
                                <img src="{{ asset('uploads/'.$dt->gambar) }}" style="width: 50px;">
                            </td>
                            <td>
                                {{ $dt->kategori_r->nama }}
                            </td>
                            <td>{{ $dt['judul'] }}</td>
                            <td>{{ $dt['penulis'] }}</td>
                            <td>{{ $dt['stocks'] }}</td>
                            <td>
                                <label class="label {{ ($dt->status == 1) ? 'label-success' : ' label-danger' }}">
                                {{ ($dt->status == 1) ? 'Aktif' : 'Tidak Aktif' }}</label>
                            </td>
                            <td>{{ $dt->created_at }}</td>

                            @if(\Auth::user()->status == 1)
                            <td>
                                <p>
                                <!-- EDIT -->
                                <a href="{{ url('master/buku/'.$dt->id) }}" 
                                class="btn btn-flat btn-xs btn-warning">
                                <i class="fa fa-pencil"></i> Edit</a>

                                 <!--DELETE  -->
                                <a href="{{ url('master/buku/'.$dt->id) }}" 
                                class="btn btn-flat btn-xs btn-danger btn-hapus">
                                <i class="fa fa-trash"></i> Delete</a>
                                </p>
                            </td>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
 
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
 
          <div class="modal-body">
 
            <div class="py-3 text-center">
              <i class="ni ni-bell-55 ni-3x"></i>
              <h4 class="heading mt-4">Apakah kamu yakin ingin menghapus data ini?</h4>
            </div>
 
          </div>
 
          <div class="modal-footer">
            <form action="" method="post">
              {{ csrf_field() }}
              {{ method_field('delete') }}
              <button type="submit" class="btn btn-white">Ok, Got it</button>
            </form>
            <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
          </div>
 
        </div>
      </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            location.reload();
        })
 
    })

</script>
 
@endsection