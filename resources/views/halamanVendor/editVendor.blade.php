
@extends('../layout/main')

@section('title','Edit:Vendor')

@section('juduldalam')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Ubah Data</h1>
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
<form method="post" action="/vendor/{{$vendor->id_vendor}}">
   @method('PATCH')
    @csrf
   <div class="card-body">
   <div class="row">
   <div class="col-md-5 offset-md-1">
        <div class="form-group">
            <label for="nama_vendor">Nama Vendor</label>
            <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="{{ $vendor->nama_vendor }}">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $vendor->alamat }}">
        </div>

        <div class="form-group">
            <label for="no_tlp">Kontak</label>
            <input type="text" class="form-control" id="no_tlp" name="no_tlp" value="{{ $vendor->no_tlp }}">
        </div>

        <div class="form-group">
            <label for="email">E-Mail</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $vendor->email }}">
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