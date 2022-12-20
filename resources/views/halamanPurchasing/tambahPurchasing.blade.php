@extends('../layout/main')

@section('title','Tambah Data')

@section('juduldalam')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Tambah Data</h1>
            </div>
        </div>
        </div>
         <div class="col-sm-8">
             <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                       <!-- <li><i>Tambah Data</i></li> -->
                    </ol>
                </div>
            </div>
        </div>
</div>
@endsection

@section('konten')
<!-- <div class="container"> -->
<form method="post" action="/purchasing">
   @csrf
   <!-- name adalah hal yang penting, sesuaikan dengan database -->
   <div class="card-body">
   <div class="row">
   <div class="col-md-5 offset-md-1">
        <div class="form-group">
            <label for="id_vendor">Pilih Vendor</label>
            <select name="id_vendor" class="form-control" id="id_vendor">
                <option value="">-- pilih --</option>
                @foreach($vendor as $data)
                <option value="{{ $data->id_vendor }}">{{ $data->nama_vendor }}</option>
                @endforeach
            </select>
        </div> 

        <div class="form-group">
            <label for="nama_material">Nama Material</label>
            <input type="text" class="form-control" id="nama_material" name="nama_material" value="{{ old('nama_material') }}">
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah') }}">
        </div>

        <div class="form-group">
            <label for="satuan">Satuan</label>
            <select name="satuan" class="form-control" id="satuan" name="satuan" value="{{ old('satuan') }}">
                <option value="">-- pilih --</option>
                <option value="pc/s">pc/s</option>
                <option value="kg/s">kg</option>
                <option value="m/s">m</option>
                <option value="lusin">lusin</option>
            </select>    
        </div>

        <div class="form-group">
            <label for="tanggal_order">Tanggal Order</label>
            <input type="date" class="form-control" id="tanggal_order" name="tanggal_order" value="{{ old('tanggal_order') }}">
        </div>

        <div class="form-group">
            <label for="total_harga">Harga</label>
            <input type="text" class="form-control" id="total_harga" name="total_harga" value="{{ old('total_harga') }}">
        </div>

        <div class="form-group">
            <input type="hidden" class="form-control" id="status" name="status" value="Request for Quotation">
        </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
    </div>
</form>
    </tbody>
    </table>
<!-- </div> -->
@endsection     