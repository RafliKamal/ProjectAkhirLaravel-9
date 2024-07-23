@extends('/master')

@section('title')
    Bank Soal
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
                <form class="forms-sample" action="/updateSoal2" method="POST" enctype="multipart/form-data">
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

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h3>Bank Soal</h3>
                <div class="mt-4">
                    <select class="form-select" id="matkulSelect" aria-label="Pilih Mata Kuliah">
                        <option value="" disabled selected hidden>Pilih Mata Kuliah untuk Melihat Soal</option>
                        @foreach ($dataMatkul as $m)
                            <option value="{{ $m->matkul_id }}">{{ $m->namaMatkul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container-fluid mt-4" id="soalContainer">
                    <!-- Soal-soal akan dimuat di sini melalui JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('matkulSelect').addEventListener('change', function() {
    const matkulId = this.value;
    fetch(`/getSoalByMatkul/${matkulId}`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('soalContainer');
            container.innerHTML = ''; // Clear container
            data.forEach((soal, index) => {
                const soalDiv = document.createElement('div');
                soalDiv.classList.add('mb-5');
                soalDiv.innerHTML = `
                    <div class="d-flex">
                        <div class="ms-2 me-4 mt-1">
                            <label>${index + 1}</label>
                        </div>
                        <div class="input-group mt-2">
                            <h5>${soal.teksSoal}</h5>
                        </div>
                    </div>
                    ${soal.filePath ? `<div class="ms-5 mt-2"><img src="${soal.filePath}" height="250px"></div>` : ''}
                    <div class="d-flex justify-content-start mt-2 ms-5">
                        <a href="#" type="button"
                            class="btn btn-warning px-3 edit-soal-btn" data-bs-toggle="modal"
                            data-bs-target="#editDataModal" data-id="${soal.soal_id}"
                            data-matkul="${soal.matkul_id}"
                            data-soal="${soal.teksSoal}" data-file="${soal.filePath || ''}">
                            Edit
                        </a>
                        <a href="/hapusSoal2/${soal.soal_id}" type="button"
                            class="btn btn-danger btn-lg ms-2">Hapus</a>
                    </div>
                `;
                container.appendChild(soalDiv);
            });

            // Tambahkan event listener untuk tombol edit setelah soal dimuat
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
                    if (filePath && filePath !== 'null') {
                        fileDisplay.innerHTML = `<img src="${filePath}" height="100px">`;
                        fileText.value = filePath;
                    } else {
                        fileDisplay.innerHTML = '';
                        fileText.value = '';
                    }
                });
            });
        })
        .catch(error => console.error('Error:', error));
});

</script>
@endsection
