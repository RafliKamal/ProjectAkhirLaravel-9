@extends('/master')

@section('title')
    Revisi Ujian
@endsection
 
@section('halaman_utama')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="/simpanRevisi" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="ujian_id" value="{{ $dataUjian->ujian_id }}">
                        <div class="form-group row">
                            <div class="form-group col">
                                <label for="exampleInputEmail1" class="mt-3 mb-2">Mata Kuliah</label>
                                <input type="text" class="form-control" name="matkul" id="matkul" value="{{ $dataUjian->matkul->namaMatkul }}" readonly>
                            </div>
                            <div class="form-group col-2">
                                <label for="exampleInputEmail1" class="mt-3 mb-2">Tanggal Ujian</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Tanggal Ujian" name="tanggal" value="{{ $dataUjian->formattedTanggalUjian }}">
                                    @error('tanggal')
                                    <div class="invalid-feedback" style="font-size: 13px;">
                                        {{ $message }}
                                        <br>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-4">
                                <label for="exampleInputEmail1" class="">Jenis Ujian</label>
                                <select class="form-select @error('jenisUjian') is-invalid @enderror" aria-label="Pilih Jenis Ujian" name="jenisUjian" id="jenisUjian">
                                    <option value="" disabled selected hidden>Pilih Jenis Ujian</option>
                                    <option value="UJIAN TENGAH SEMESTER" {{ $dataUjian->jenisUjian == 'UJIAN TENGAH SEMESTER' ? 'selected' : '' }}>Ujian Tengah Semester</option>
                                    <option value="UJIAN AKHIR SEMESTER" {{ $dataUjian->jenisUjian == 'UJIAN AKHIR SEMESTER' ? 'selected' : '' }}>Ujian Akhir Semester</option>
                                </select>
                                @error('jenisUjian')
                                    <div class="invalid-feedback" style="font-size: 13px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="exampleInputEmail1">Tipe Ujian</label>
                                <select class="form-select @error('tipeSoal') is-invalid @enderror" aria-label="Pilih Tipe Ujian" name="tipeSoal" id="tipeSoal">
                                    <option value="" disabled selected hidden>Pilih Tipe Ujian</option>
                                    <option value="PG" {{ $dataUjian->tipeSoal == 'PG' ? 'selected' : '' }}>Pilihan Ganda</option>
                                    <option value="Essay" {{ $dataUjian->tipeSoal == 'Essay' ? 'selected' : '' }}>Essay</option>
                                    <option value="Project" {{ $dataUjian->tipeSoal == 'Project' ? 'selected' : '' }}>Project</option>
                                </select>
                                @error('tipeSoal')
                                    <div class="invalid-feedback" style="font-size: 13px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="exampleInputEmail1">Sifat Ujian</label>
                                <select class="form-select @error('sifatUjian') is-invalid @enderror" aria-label="Pilih Sifat Ujian" name="sifatUjian" id="sifatUjian">
                                    <option value="" disabled selected hidden>Pilih Sifat Ujian</option>
                                    <option value="Open Book" {{ $dataUjian->sifatUjian == 'Open Book' ? 'selected' : '' }}>Open Book</option>
                                    <option value="Close Book" {{ $dataUjian->sifatUjian == 'Close Book' ? 'selected' : '' }}>Close Book</option>
                                    <option value="TakeHome" {{ $dataUjian->sifatUjian == 'TakeHome' ? 'selected' : '' }}>Take Home</option>
                                </select>
                                @error('sifatUjian')
                                    <div class="invalid-feedback" style="font-size: 13px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="exampleInputEmail1" class="mb-2">Durasi Ujian</label>
                                <input type="text" class="form-control @error('durasiUjian') is-invalid @enderror" id="exampleInputEmail1" placeholder="Durasi Ujian" name="durasiUjian" value="{{ $dataUjian->durasiUjian }}">
                                @error('durasiUjian')
                                    <div class="invalid-feedback" style="font-size: 13px;">
                                        {{ $message }}
                                        <br>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="exampleInputEmail1">Tahun Akademik</label>
                                <select class="form-select @error('tahunAkademik') is-invalid @enderror" aria-label="Pilih Tahun Akademik" name="tahunAkademik" id="tahunAkademik">
                                    <option value="" disabled selected hidden>Pilih Tahun Akademik</option>
                                    <option value="2023 - 2024 Ganjil" {{ $dataUjian->tahunAkademik == '2023 - 2024 Ganjil' ? 'selected' : '' }}>2023 / 2024 Ganjil</option>
                                    <option value="2023 - 2024 Genap" {{ $dataUjian->tahunAkademik == '2023 - 2024 Genap' ? 'selected' : '' }}>2023 / 2024 Genap</option>
                                </select>
                                @error('tahunAkademik')
                                    <div class="invalid-feedback" style="font-size: 13px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlTextarea1" class="mb-2">Komentar Kaprodi</label>
                            <input type="text" class="form-control" name="matkul" id="matkul" value="{{ $dataUjian->komentar}}" readonly>
                    
                        </div>
                    
                        <div class="container-fluid">
                            <h3 class="text-info mt-3">Soal Sebelumnya</h3>
                            @foreach ($dataSoalUjian as $index => $s)
                                <div class="mb-5 mt-3">
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
                    
                        <div class="container-fluid mt-5">
                            <h3 class="text-info">Pilih Soal Kembali</h3>
                            @foreach ($dataSoalKeseluruhan as $s)
                                <div class="mb-5 mt-3">
                                    <div class="d-flex">
                                        <div class="form-check ms-2">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="soal[]" value="{{ $s->soal_id }}" {{ in_array($s->soal_id, old('soal', [])) ? 'checked' : '' }}>
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>
                                        <div class="input-group mt-3">
                                            <h5>{{ $s->teksSoal }}</h5>
                                        </div>
                                    </div>
                                    @if($s->filePath)
                                        <div class="ms-5">
                                            <img src="{{ asset($s->filePath) }}" height="250px">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2 mt-3">Submit</button>
                            <a href="/BuatUjian"><button type="button" class="btn btn-light mt-3">Cancel</button></a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

