@extends('../layout/main')

@section('title','Invoice')

@section('juduldalam')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1 style="font-size:30px;">Invoice</h1>
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
        <strong>Data Invoicing</strong>
    </div>
    <table class="table table-striped">
    <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Kode Order</th>
            <th>Nama Customer</th>
            <th>Pesanan</th>
            <th>Jumlah pcs</th>
            <th>Tanggal Order</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table table-hover">
   
    @foreach($data as $data)
        <tr class="text=center">
            <td>{{$loop->iteration}}</td>
            <td>{{$data->kode_order}}</td>
            <td>{{$data->nama_pemesan}}</td>
            <td>{{$data->pesan_produk}}</td>
            <td>{{$data->value}}</td>
            <td>{{$data->tanggal_order}}</td>
            <td>Rp {{$data->total_harga}}</td>
            <td>{{$data->status}}</td>
            <td>
                <div class="card-body">
                    <!-- <a href="invoice/{{$data->id_invoice}}/edit" class="btn-sm btn-primary rounded tombol">Post</a> -->
                    <a href="payment/{{$data->id_invoice}}" class="btn-sm btn-primary rounded tombol">Register Payment</a>
                    <form action="/invoice/{{$data->id_invoice}}" method="post" class="ini">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn-xs btn-danger rounded" onclick="return confirm('Are you sure?')" style="font-size:13.5px">Hapus</buton>          
                    </form> 
                    <div class="clear"></div>
                </div>
            </td>
            <td>
                <div class="card-body">
                    <a href="invoice/print" class="btn-sm btn-primary">Print</a>
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
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
@endsection