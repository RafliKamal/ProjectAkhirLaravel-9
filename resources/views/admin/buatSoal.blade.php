@extends('/master')

@section('title')
    Membuat Soal
@endsection

@section('halaman_utama')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="/simpanSoal" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Mata Kuliah</label>
                            <select class="form-select @error('matkul_id') is-invalid @enderror"
                                aria-label="Pilih Mata Kuliah" name="matkul_id" id="matkul_id" value="{{ old('matkul') }}">
                                <option value="" disabled selected hidden>Pilih Mata Kuliah</option>
                                @foreach ($dataMatkul as $m)
                                    <option value="{{ $m->matkul_id }}" class="text-light">{{ $m->namaMatkul }}</option>
                                @endforeach
                            </select>
                            @error('matkul_id')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlTextarea1" class="mb-2">Text Soal</label>
                            <textarea class="form-control @error('teksSoal') is-invalid @enderror" id="exampleFormControlTextarea1"
                                style="height: 100px" placeholder="Ketik Soal Disini" name="teksSoal">{{ old('teksSoal') }}</textarea>
                            @error('teksSoal')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                    <br>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="mt-3 mb-2">Lampirkan Gambar</label>
                            <input type="file" name="filePath" class="file-upload-default @error('filePath') is-invalid @enderror" id="file-upload">
                            <div class="input-group col-xs-12 d-flex align-items-center">
                                <input type="text" class="form-control file-upload-info" disabled=""
                                    placeholder="Upload Gambar">
                                <span class="input-group-append ms-2">
                                    <button class="file-upload-browse btn btn-primary" type="button" onclick="document.getElementById('file-upload').click();">Upload</button>
                                </span>
                            </div>
                            @error('filePath')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2 mt-3">Submit</button>
                        <button type="button" class="btn btn-light mt-3" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileUpload = document.getElementById('file-upload');
        const fileUploadInfo = document.querySelector('.file-upload-info');

        fileUpload.addEventListener('change', function () {
            fileUploadInfo.value = fileUpload.value.split('\\').pop();
        });
    });
</script>
