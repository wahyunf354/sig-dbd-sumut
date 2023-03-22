@extends('admin.layouts.index')

@section('content')
<div class="controller-lg">
  <div class="row">
    <div class="col-12 col-md-8">
      <div class="card">
        <div class="card-header">
          <h3>Unggah File Laporan DBD</h3>
        </div>
        <div class="card-body">
          <form action="{{route('admin.post.uploadLaporanDBD')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <input class="form-control" type="file" id="laporan_dbd" name="laporan_dbd" value="{{old("laporan_dbd")}}">
            </div>
            <button class="btn btn-primary mb-3" type="submit">Unggah</button>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection