@extends('../layout/main')

@section('title','Purchasing')

@section('juduldalam')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1 style="font-size:30px;">Purchasing</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('konten')
<div class="container">
    <div class="card">
    <div class="card-body">
    <div class="pull-left" style="margin-bottom:10px">
        <strong>Data Purchasing</strong>
    </div>
    <div class="pull-right">
        <a href="/purchasing/tambah" class="btn-sm btn-success rounded mb-5">Create</a>
    </div>
    <table class="table table-striped">
    <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Nama Vendor</th>
            <th>Nama Material</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tanggal Order</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody class="table table-hover">
   
    @foreach($data as $data)
        <tr class="text=center">
            <td>{{$loop->iteration}}</td>
            <td>{{$data->vendors['nama_vendor']}}</td>
            <td>{{$data->nama_material}}</td>
            <td>{{$data->jumlah}}</td>
            <td>{{$data->satuan}}</td>
            <td>{{$data->tanggal_order}}</td>
            <td>Rp {{$data->total_harga}}</td>
            <td>{{$data->status}}</td>
            <td>
                <div class="card-body">
                    <a href="Pesan/{{$data->id_material}}" class="btn-sm btn-primary rounded tombol">Pesan</a>
                    <a href="tambahBahanInventory/{{$data->id_material}}" class="btn-sm btn-primary rounded tombol">Konfirmasi</a>
                    <a href="purchasing/{{$data->id_material}}/edit" class="btn-sm btn-primary rounded tombol">Ubah</a>
                    <form action="/purchasing/{{$data->id_material}}" method="post" class="ini">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn-xs btn-danger rounded" onclick="return confirm('Are you sure?')" style="font-size:13.5px">Hapus</buton>          
                    </form>
                    <div class="clear"></div>
                </div>
            </td>
        </tr>
    </div>
    @endforeach

    </tbody>
    </table>
    </div>
    </div>
    </div>
<!-- </div> -->
@if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
@endsection