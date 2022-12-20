@extends('../layout/main')

@section('title','Edit')

@section('juduldalam')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Edit Data</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('konten')
<!-- <div class="container"> -->
<form method="post" action="/inventory/{{$inventory->id_barang}}">
    @method('PATCH')
   @csrf
   <!-- name adalah hal yang penting, sesuaikan dengan database -->
   <div class="card-body">
   <div class="row">
   <div class="col-md-5 offset-md-1">

        <div class="form-group">
            <label for="on_hand">Jumlah stok</label>
            <input type="text" class="form-control" id="on_hand" name="on_hand" value="{{ $inventory->on_hand }}">
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