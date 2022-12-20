
@extends('../layout/main')

@section('title','Edit:Kontak')

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
<form method="post" action="/contact/{{$contact->id_kontak}}">
   @method('PATCH')
    @csrf
   <div class="card-body">
   <div class="row">
   <div class="col-md-5 offset-md-1">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $contact->nama }}">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $contact->alamat }}">
        </div>

        <div class="form-group">
            <label for="no_tlp">No Telepon</label>
            <input type="text" class="form-control" id="no_tlp" name="no_tlp" value="{{ $contact->no_tlp }}">
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