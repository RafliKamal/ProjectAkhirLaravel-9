@extends('/master')

@section('title')
    Buat Ujian
@endsection
 
@section('halaman_utama')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="/simpanUjian" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                      
                        <div class="form-group row">
                            <div class="form-group col">
                                <label for="exampleInputEmail1" class="mt-3 mb-2">Mata Kuliah</label>
                                <input type="hidden" class="form-control" name="matkul_id" id="matkul_id" value="{{ $dataMatkul->matkul_id }}" readonly>
                                <input type="text" class="form-control" name="matkul" id="matkul" value="{{ $dataMatkul->namaMatkul }}" readonly>
                            </div>
                            <div class="form-group col-2">
                                <label for="exampleInputEmail1" class="mt-3 mb-2">Tanggal Ujian</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Tanggal Ujian" name="tanggal">
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
                                    <option value="UJIAN TENGAH SEMESTER">Ujian Tengah Semester</option>
                                    <option value="UJIAN AKHIR SEMESTER">Ujian Akhir Semester</option>
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
                                    <option value="Pilihan Ganda">Pilihan Ganda</option>
                                    <option value="Essay">Essay</option>
                                    <option value="Project">Project</option>
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
                                    <option value="Open Book">Open Book</option>
                                    <option value="Close Book">Close Book</option>
                                    <option value="Take Home">Take Home</option>
                                </select>
                                @error('sifatUjian')
                                    <div class="invalid-feedback" style="font-size: 13px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="exampleInputEmail1" class="mb-2">Durasi Ujian</label>
                                <input type="text" class="form-control @error('durasiUjian') is-invalid @enderror" id="exampleInputEmail1" placeholder="Durasi Ujian" name="durasiUjian">
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
                                    <option value="2023 - 2024 Ganjil">2023 / 2024 Ganjil</option>
                                    <option value="2023 - 2024 Genap">2023 / 2024 Genap</option>
                                </select>
                                @error('tahunAkademik')
                                    <div class="invalid-feedback" style="font-size: 13px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="container-fluid mt-5">
                            <h3 class="text-info">Pilih Soal</h3>
                            @foreach ($dataSoal as $s)
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