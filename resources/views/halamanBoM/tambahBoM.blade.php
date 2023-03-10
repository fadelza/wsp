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
<form method="post" action="/bom">
   @csrf
   <!-- name adalah hal yang penting, sesuaikan dengan database -->
   <div class="card-body">
   <div class="row">
   <div class="col-md-5 offset-md-1">

        <div class="form-group">
            <label for="id_produk">Pilih Produk</label>
            <select name="id_produk" class="form-control" id="id_produk">
                <option value="">-- pilih --</option>
                @foreach($produk as $data)
                    <option value="{{ $data->id_produk }}">{{ $data->nama_produk }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nama_bahan">Nama Bahan</label>
            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" value="{{ old('nama_bahan') }}">
        </div>

        <div class="form-group">
            <label for="value">Jumlah</label>
            <input type="text" class="form-control" id="value" name="value" value="{{ old('value') }}">
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
        
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
    </div>
</form>
    </tbody>
    </table>
<!-- </div> -->
@endsection     