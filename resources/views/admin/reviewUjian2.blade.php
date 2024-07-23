@extends('/master')

@section('title')
    Review Ujian
@endsection


@section('halaman_utama')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                @foreach ($dataUjian as $x)
                    <form class="forms-sample" action="/simpanReview/{{$x->ujian_id}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                            <div class="form-group row">
                                <div class="form-group col">
                                    <label for="exampleInputEmail1" class="mt-3 mb-2">Mata Kuliah</label>
                                    <input type="text" class="form-control" name="matkul" id="matkul"
                                        value="{{ $x->matkul->namaMatkul }}" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label for="exampleInputEmail1" class="mt-3 mb-2">Tanggal Ujian</label>
                                    <input type="date" class="form-control" name="tanggal" value="{{ $x->tanggalUjian }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-4">
                                    <label for="exampleInputEmail1">Jenis Ujian</label>
                                    <input type="text" class="form-control" name="jenisUjian"
                                        value="{{ $x->jenisUjian }}" readonly>
                                </div>
                                <div class="form-group col">
                                    <label for="exampleInputEmail1">Tipe Ujian</label>
                                    <input type="text" class="form-control" name="tipeSoal" value="{{ $x->tipeSoal }}"
                                        readonly>
                                </div>
                                <div class="form-group col">
                                    <label for="exampleInputEmail1">Sifat Ujian</label>
                                    <input type="text" class="form-control" name="sifatUjian"
                                        value="{{ $x->sifatUjian }}" readonly>
                                </div>
                                <div class="form-group col">
                                    <label for="exampleInputEmail1" class="mb-2">Durasi Ujian</label>
                                    <input type="text" class="form-control" name="durasiUjian"
                                        value="{{ $x->durasiUjian }}" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label for="exampleInputEmail1">Tahun Akademik</label>
                                    <input type="text" class="form-control" name="tahunAkademik"
                                        value="{{ $x->tahunAkademik }}" readonly>
                                </div>
                            </div>
                        @endforeach

                        <div class="container-fluid">
                            @foreach ($dataSoal as $index => $s)
                                <div class="mb-5">
                                    <div class="d-flex">
                                        <div class="ms-2 me-4 mt-1">
                                            <label>{{ $index + 1 }}</label>
                                            <!-- Menggunakan $index + 1 untuk nomor soal -->
                                        </div>
                                        <div class="input-group mt-2">
                                            <h5>{{ $s->teksSoal }}</h5>
                                        </div>
                                    </div>
                                    @if ($s->filePath)
                                        <div class="ms-5">
                                            <img src="{{ asset($s->filePath) }}" height="250px">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5 mb-2">
                            <label for="exampleFormControlTextarea1" class="mb-2">Status Ujian</label>
                            <select class="form-select @error('status') is-invalid @enderror" aria-label="Pilih Status Ujian"
                            name="status" id="status">
                            <option disabled selected hidden>Pilih Status Ujian</option>
                            <option value="Disetujui" class="text-light">Ujian Disetujui</option>
                            <option value="Revisi" class="text-light">Ajukan Revisi</option>
                        </select>
                        </div>

                        <div class="mt-5 mb-2">
                            <label for="exampleFormControlTextarea1" class="mb-2">Kolom Komentar</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" style="height: 100px"
                                placeholder="Ketik Komentar Disini" name="komentar"></textarea>
                        </div>

                        

                        

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2 mt-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
