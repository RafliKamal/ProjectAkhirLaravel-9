@extends('/master')

@section('title')
    Table Mata Kuliah
@endsection

@section('halaman_utama')
    <!-- Button trigger modal tambah data -->
    <button type="button" class="btn btn-social-icon-text btn-facebook mb-4" data-bs-toggle="modal"
        data-bs-target="#tambahDataModal">
        <i class="ti-plus"></i>Tambah Data
    </button>

    <!-- Modal tambah data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="/simpanMatkul" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputUsername1" class="mt-3 mb-2">Mata Kuliah ID</label>
                            <input type="text" class="form-control @error('matkul_id') is-invalid @enderror"
                                id="exampleInputUsername1" placeholder="ID Mata Kuliah" name="matkul_id"
                                value="{{ old('matkul_id') }}">
                            @error('matkul_id')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                    <br>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Prodi</label>
                            <select class="form-select prodi_id @error('semester') is-invalid @enderror" aria-label="Pilih Prodi"
                                name="prodi_id"  value="{{ old('prodi_id') }}">
                                <option value="" disabled selected hidden>Pilih Prodi</option>
                                @foreach ($dataProdi as $p)
                                    <option value="{{ $p->prodi_id }}" class="text-light">{{ $p->namaProdi }}</option>
                                @endforeach
                            </select>
                            @error('prodi_id')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Dosen</label>
                            <select class="form-select user_id @error('semester') is-invalid @enderror" aria-label="Pilih Dosen"
                                name="user_id" id="user_id" value="{{ old('user_id') }}">
                                <option value="" disabled selected hidden>Pilih Dosen</option>
                                @foreach ($dataUser as $u)
                                    <option value="{{ $u->user_id }}" data-prodi="{{ $u->prodi_id }}" class="text-light">
                                        {{ $u->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Mata Kuliah</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Nama Mata Kuliah" name="namaMatkul"
                                value="{{ old('namaMatkul') }}">
                            @error('namaMatkul')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                    <br>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="exampleInputEmail1" class="mt-3 mb-2 ">Semester</label>
                            <select class="form-select  @error('semester') is-invalid @enderror" aria-label="Pilih Semester"
                                name="semester" id="semester" value="{{ old('semester') }}">
                                <option value="" disabled selected hidden>Pilih Semester</option>
                                <option value="1" class="text-light">Semester 1</option>
                                <option value="2" class="text-light">Semester 2</option>
                                <option value="3" class="text-light">Semester 3</option>
                                <option value="4" class="text-light">Semester 4</option>
                                <option value="5" class="text-light">Semester 5</option>
                                <option value="6" class="text-light">Semester 6</option>
                                <option value="7" class="text-light">Semester 7</option>
                                <option value="8" class="text-light">Semester 8</option>
                            </select>
                            @error('role')
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

    <!-- Modal edit data -->
    <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataModalLabel">Tambah Data Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="/updateMatkul" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputUsername1" class="mt-3 mb-2">Mata Kuliah ID</label>
                            <input type="text" class="form-control @error('matkul_id') is-invalid @enderror" id="exampleInputUsername1" placeholder="ID Mata Kuliah" name="matkul_id" value="{{ old('matkul_id') }}">
                            @error('matkul_id')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                    <br>
                                </div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Prodi</label>
                            <select class="form-select prodi_id @error('prodi_id') is-invalid @enderror" aria-label="Pilih Prodi" name="prodi_id" value="{{ old('prodi_id') }}">
                                <option value="" disabled selected hidden>Pilih Prodi</option>
                                @foreach ($dataProdi as $p)
                                    <option value="{{ $p->prodi_id }}" class="text-light">{{ $p->namaProdi }}</option>
                                @endforeach
                            </select>
                            @error('prodi_id')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Dosen</label>
                            <select class="form-select user_id @error('user_id') is-invalid @enderror" aria-label="Pilih Dosen" name="user_id"  value="{{ old('user_id') }}">
                                <option value="" disabled selected hidden>Pilih Dosen</option>
                                @foreach ($dataUser as $u)
                                    <option value="{{ $u->user_id }}" data-prodi="{{ $u->prodi_id }}" class="text-light">{{ $u->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Mata Kuliah</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror" id="exampleInputEmail1" placeholder="Nama Mata Kuliah" name="namaMatkul" value="{{ old('namaMatkul') }}">
                            @error('namaMatkul')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                    <br>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="exampleInputEmail1" class="mt-3 mb-2 ">Semester</label>
                            <select class="form-select  @error('semester') is-invalid @enderror" aria-label="Pilih Semester" name="semester" id="semester" value="{{ old('semester') }}">
                                <option value="" disabled selected hidden>Pilih Semester</option>
                                <option value="1" class="text-light">Semester 1</option>
                                <option value="2" class="text-light">Semester 2</option>
                                <option value="3" class="text-light">Semester 3</option>
                                <option value="4" class="text-light">Semester 4</option>
                                <option value="5" class="text-light">Semester 5</option>
                                <option value="6" class="text-light">Semester 6</option>
                                <option value="7" class="text-light">Semester 7</option>
                                <option value="8" class="text-light">Semester 8</option>
                            </select>
                            @error('role')
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

    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-8">
                            <h4 class="card-title">Data Mata Kuliah</h4>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table text-center ">
                            <thead>
                                <tr>
                                   
                                    <th> Matkul_Id </th>
                                    <th> Nama Dosen </th>
                                    <th> Nama Mata Kuliah </th>
                                    <th> Semester </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataMatkul as $m)
                                    <tr>
                                        
                                        <td> {{ $m->matkul_id }} </td>
                                        <td> {{ $m->user->name }}</td>
                                        <td> {{ $m->namaMatkul }} </td>
                                        <td> {{ $m->semester }} </td>
                                        <td>
                                            <button type="button" 
                                            class="btn btn-outline-warning px-3 edit-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editDataModal"
                                            data-matkul_id="{{ $m->matkul_id }}"
                                            data-user_id="{{ $m->user_id }}"
                                            data-prodi_id="{{ $m->prodi_id }}"
                                            data-nama_matkul="{{ $m->namaMatkul }}"
                                            data-semester="{{ $m->semester }}">
                                        Edit
                                    </button>
                                            <a href="/hapusMatkul/{{$m->matkul_id}}" type="button"
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.prodi_id').change(function() {
                var selectedProdi = $(this).val();
                $('.user_id option').each(function() {
                    var prodiId = $(this).data('prodi');
                    if (prodiId == selectedProdi || !prodiId) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $('.user_id').val(''); // Reset Nama Dosen selection
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editButtons = document.querySelectorAll('.edit-btn');
            var matkulIdInput = document.querySelector('#editDataModal input[name="matkul_id"]');
            var userIdSelect = document.querySelector('#editDataModal select[name="user_id"]');
            var prodiIdSelect = document.querySelector('#editDataModal select[name="prodi_id"]');
            var namaMatkulInput = document.querySelector('#editDataModal input[name="namaMatkul"]');
            var semesterSelect = document.querySelector('#editDataModal select[name="semester"]');
    
            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var matkulId = button.getAttribute('data-matkul_id');
                    var userId = button.getAttribute('data-user_id');
                    var prodiId = button.getAttribute('data-prodi_id');
                    var namaMatkul = button.getAttribute('data-nama_matkul');
                    var semester = button.getAttribute('data-semester');
    
                    matkulIdInput.value = matkulId;
                    namaMatkulInput.value = namaMatkul;
                    
                    // Set selected value for prodi_id
                    for (var i = 0; i < prodiIdSelect.options.length; i++) {
                        if (prodiIdSelect.options[i].value == prodiId) {
                            prodiIdSelect.options[i].selected = true;
                            break;
                        }
                    }
    
                    // Set selected value for user_id
                    for (var i = 0; i < userIdSelect.options.length; i++) {
                        if (userIdSelect.options[i].value == userId) {
                            userIdSelect.options[i].selected = true;
                            break;
                        }
                    }
    
                    // Set selected value for semester
                    for (var i = 0; i < semesterSelect.options.length; i++) {
                        if (semesterSelect.options[i].value == semester) {
                            semesterSelect.options[i].selected = true;
                            break;
                        }
                    }
                });
            });
        });
    </script>
    
@endsection
