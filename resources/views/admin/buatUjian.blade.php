@extends('/master')

@section('title')
    Membuat Ujian
@endsection

@section('halaman_utama')
    <div class="row">
        <h3>Tambahkan Ujian</h3>
        <div class="col-12 grid-margin mt-2">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="/BuatUjian2" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col">
                                <label for="matkul" class="mt-3 mb-2">Mata Kuliah</label>
                                <select class="form-select text-danger @error('matkul') is-invalid @enderror" name="matkul" id="matkul">
                                    <option disabled selected hidden>Pilih Mata Kuliah</option>
                                    @foreach ($dataMatkul as $m)
                                        <option value="{{ $m->matkul_id }}" class="text-light">{{ $m->namaMatkul }}</option>
                                    @endforeach
                                </select>
                                @error('matkul')
                                    <div class="invalid-feedback" style="font-size: 13px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2 mt-3">Submit</button>
                            <button type="button" class="btn btn-light mt-3" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <h3>Daftar Ujian</h3>
        @auth
        @foreach ($dataUjian as $x)
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card mt-3">
                    <div class="card-body text-secondary @if($x->status == 'Revisi') btn-inverse-danger @elseif($x->status == 'Disetujui') btn-inverse-success @elseif($x->status == 'Menunggu Review') btn-inverse-warning @endif">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $x->matkul->namaMatkul }}</h3>
                                </div>
                            </div>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-3">Semester {{ $x->matkul->semester }} - {{ $x->jenisUjian }}</h5>
                        <h5 class="font-weight-normal mt-2">Status Ujian: {{ $x->status }}</h5>
                        <a href="lihatUjian2/{{ $x->ujian_id }}" class="btn btn-lg btn-primary mt-3 me-1">Lihat</a>
                        @if($x->status == 'Revisi')
                            <a href="revisiUjian/{{ $x->ujian_id }}" class="btn btn-lg btn-danger mt-3">Revisi</a>
                        @else
                            <a href="revisiUjian/{{ $x->ujian_id }}" class="btn btn-lg btn-warning mt-3 px-3">Edit</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        @endauth
    </div>
@endsection
