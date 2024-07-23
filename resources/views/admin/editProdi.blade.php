@extends('/master')

@section('title')
    Edit Prodi
@endsection

@section('halaman_utama')
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="/updateProdi/{{ $prodi->prodi_id }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputUsername1" class="mt-3 mb-2">Prodi ID</label>
                        <input type="text" class="form-control @error('prodi_id') is-invalid @enderror" id="exampleInputUsername1"
                            placeholder="ID" name="prodi_id" value="{{ $prodi->prodi_id }}">
                        @error('prodi_id')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Prodi</label>
                        <input type="text" class="form-control @error('namaProdi') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Nama Prodi" name="namaProdi" value="{{ $prodi->namaProdi }}">
                        @error('namaProdi')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Kaprodi</label>
                        <input type="text" class="form-control @error('namaKaprodi') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Nama Kaprodi" name="namaKaprodi" value="{{ $prodi->namaKaprodi }}">
                        @error('namaKaprodi')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                        @enderror
                    </div>
            
                    <button type="submit" class="btn btn-primary me-2 mt-3">Submit</button>
                    <a href="/tbProdi"><button type="button" class="btn btn-light mt-3" >Cancel</button></a>                </form>

            </div>
        </div>
    </div>
</div>


@endsection
