<!DOCTYPE html>
<html>
<head>
  @include('layouts.head')
</head>
<body>
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-body">
                <table class="table table-hover myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Status</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                  
                        @foreach($data as $e=>$dt)
                        <tr>
                            <td>{{ $e+1 }}</td>
                            <td>{{ $dt->user_r['name'] }}</td>
                            <td>{{ $dt->buku_r['judul'] }}</td>
 
                           
                            <td>{{ $dt->status_r['nama'] }}</td>
 
 
                            <td>{{ date('d F Y H:i:s',strtotime($dt->created_at)) }}</td>
                        </tr>
                        @endforeach 
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 </body>

<script>
		window.print();
	</script>
    </html>