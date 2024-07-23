@extends('/master')

@section('title')
    Table Soal
@endsection

@section('halaman_utama')
<!-- Modal edit data -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Edit Data Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" action="/updateSoal" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="edit-soal-id" name="soal_id">
                    <input type="hidden" id="edit-file-path" name="file_path">
                    <div class="form-group">
                        <label for="edit-matkul" class="mt-3 mb-2">Mata Kuliah</label>
                        <select class="form-select" name="matkul_id" id="edit-matkul">
                            <option value="" disabled selected hidden>Pilih Mata Kuliah</option>
                            @foreach ($dataMatkul as $m)
                                <option value="{{ $m->matkul_id }}">{{ $m->namaMatkul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit-soal" class="mb-2">Text Soal</label>
                        <textarea class="form-control" id="edit-soal" name="teksSoal"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-3 mb-2">Lampirkan Gambar</label>
                        <input type="file" name="filePath" class="file-upload-default" id="edit-file-input">
                        <div class="input-group col-xs-12 d-flex align-items-center">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Gambar" id="edit-file-text">
                            <span class="input-group-append ms-2">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                        <div id="edit-current-file" class="mt-3"></div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2 mt-3">Submit</button>
                    <button type="button" class="btn btn-light mt-3" data-bs-dismiss="modal">Cancel</button>
                </form>
                
            </div>
        </div>
    </div>
</div>



    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-8">
                            <h4 class="card-title">Data Soal</h4>
                        </div>
                       
                    </div>
                    <div class="table-responsive">
                        <table class="table text-center ">
                            <thead>
                                <tr>
                                    
                                    <th> soal_Id </th>
                                    <th> Nama Mata Kuliah </th>
                                    <th> Text Soal </th>
                                    <th> Gambar </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataSoal as $s)
                                    <tr>
                                       
                                        <td> {{ $s->soal_id }} </td>
                                        <td> {{ $s->matkul->namaMatkul }} </td>
                                        <td> {{ $s->teksSoal }} </td>
                                        <td>
                                            @if ($s->filePath)
                                                <div>
                                                    <img src="{{ $s->filePath }}" height="250px">
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" type="button"
                                                class="btn btn-outline-warning px-3 edit-soal-btn" data-bs-toggle="modal"
                                                data-bs-target="#editDataModal" data-id="{{ $s->soal_id }}"
                                                data-matkul="{{ $s->matkul->matkul_id }}"
                                                data-soal="{{ $s->teksSoal }}" data-file="{{ $s->filePath }}">
                                                Edit
                                            </a>
                                            <a href="/hapusSoal/{{ $s->soal_id }}" type="button"
                                                class="btn btn-outline-danger btn-lg me-1">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-soal-btn');
    
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const soalId = this.getAttribute('data-id');
                    const matkulId = this.getAttribute('data-matkul');
                    const teksSoal = this.getAttribute('data-soal');
                    const filePath = this.getAttribute('data-file');
    
                    // Mengisi input field dengan nilai dari data atribut
                    document.querySelector('#edit-soal-id').value = soalId;
                    document.querySelector('#edit-matkul').value = matkulId;
                    document.querySelector('#edit-soal').value = teksSoal;
                    document.querySelector('#edit-file-path').value = filePath;
    
                    // Tampilkan file yang diupload sebelumnya
                    const fileDisplay = document.querySelector('#edit-current-file');
                    const fileText = document.querySelector('#edit-file-text');
                    if (filePath) {
                        fileDisplay.innerHTML = `<img src="${filePath}" height="100px">`;
                        fileText.value = filePath;
                    } else {
                        fileDisplay.innerHTML = '';
                        fileText.value = '';
                    }
                });
            });
        });
    </script>
    
    
    

@endsection
