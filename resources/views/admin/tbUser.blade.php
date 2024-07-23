@extends('/master')

@section('title')
    Table Pengguna
@endsection

@section('halaman_utama')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-social-icon-text btn-facebook mb-4" data-bs-toggle="modal"
        data-bs-target="#tambahDataModal">
        <i class="ti-plus"></i>Tambah Data
    </button>

    <!-- Modal Tambah Data-->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="/simpanUser" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Nama User" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                    <br>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Email User" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                    <br>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label for="exampleInputEmail1" class="mt-3 mb-2 ">Prodi</label>
                            <select class="form-select  @error('prodi_id') is-invalid @enderror" aria-label="Pilih Prodi"
                                name="prodi_id" id="prodi_id" value="{{ old('prodi_id') }}">
                                <option value="" disabled selected hidden>Pilih Prodi</option>
                                @foreach ($dataProdi as $p)                            
                                <option value="{{$p->prodi_id}}" class="text-light">{{$p->namaProdi}}</option>
                                @endforeach
                            </select>
                            @error('prodi_id')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Password</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Password User" name="password"
                                value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                    <br>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="exampleInputEmail1" class="mt-3 mb-2 ">Role</label>
                            <select class="form-select  @error('role') is-invalid @enderror" aria-label="Pilih Role"
                                name="role" id="role" value="{{ old('role') }}" onchange="toggleSemesterInput()">
                                <option value="" disabled selected hidden>Pilih Role</option>
                                <option value="Admin" class="text-light">Admin</option>
                                <option value="Kaprodi" class="text-light">Kaprodi</option>
                                <option value="Dosen" class="text-light">Dosen</option>
                                <option value="Mahasiswa" class="text-light">Mahasiswa</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group" id="semesterInput" style="display:none;">
                            <label for="semester" class="mt-3 mb-2">Semester</label>
                            <input type="number" class="form-control @error('semester') is-invalid @enderror"
                                id="semester" placeholder="Semester" name="semester" value="{{ old('semester') }}">
                            @error('semester')
                                <div class="invalid-feedback" style="font-size: 13px;">
                                    {{ $message }}
                                    <br>
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

<!-- Modal Edit -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Edit Data Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" action="/editUser" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" id="edit-user-id">

                    <div class="form-group">
                        <label for="name" class="mt-3 mb-2">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="edit-name"
                            placeholder="Nama User" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="mt-3 mb-2">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="edit-email" placeholder="Email User" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="mt-3 mb-2">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="edit-password" placeholder="Password User" name="password">
                        @error('password')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prodi" class="mt-3 mb-2">Prodi</label>
                        <select class="form-select @error('prodi') is-invalid @enderror" aria-label="Pilih Prodi" name="prodi" id="edit-prodi">
                            @foreach ($dataProdi as $p)
                                <option value="{{ $p->prodi_id }}">{{ $p->namaProdi }}</option>
                            @endforeach
                        </select>
                        @error('prodi')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role" class="mt-3 mb-2">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" aria-label="Pilih Role"
                            name="role" id="edit-role" >
                            <option value="" disabled selected hidden>Pilih Role</option>
                            <option value="Admin" class="text-light">Admin</option>
                            <option value="Kaprodi">Kaprodi</option>
                            <option value="Dosen">Dosen</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group" id="editSemesterInput" style="display:none;">
                        <label for="edit-semester" class="mt-3 mb-2">Semester</label>
                        <input type="number" class="form-control @error('semester') is-invalid @enderror"
                            id="edit-semester" placeholder="Semester" name="semester" value="{{ old('semester') }}">
                        @error('semester')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
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
                            <h4 class="card-title">Data Pengguna</h4>
                        </div>
                        <div class="col-4 container-fluid">
                            <form class="d-flex" role="search" method="GET" action="/cariUser">
                                {{ csrf_field() }}
                                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search"
                                    name="cari">
                                <button class="btn btn-outline-info" value="cari" type="submit">Search</button>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-center ">
                            <thead>
                                <tr>
                                  
                                    <th> User_Id </th>
                                    <th> Nama </th>
                                    <th> Email </th>
                                    <th> Prodi </th>
                                    <th> Role </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUser as $x)
                                    <tr>
                                        <td> {{ $x->user_id }} </td>
                                        <td> {{ $x->name }}</td>
                                        <td> {{ $x->email }} </td>
                                        <td> {{ $x->prodi->namaProdi }} </td>
                                        <td> {{ $x->role }} </td>
                                        <td>
                                            <a href="" type="button"
                                                class="btn btn-outline-warning px-3 edit-user-btn" data-bs-toggle="modal"
                                                data-bs-target="#editDataModal" data-id="{{ $x->user_id }}"
                                                data-name="{{ $x->name }}" data-email="{{ $x->email }}"
                                                data-prodi="{{ $x->prodi->namaProdi }}"
                                                data-prodi-id="{{ $x->prodi->prodi_id }}"
                                                data-role="{{ $x->role }}"
                                                data-semester="{{$x->semester}}">
                                                Edit
                                            </a>
                                            <a href="/hapusUser/{{ $x->user_id }}" type="button"
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
         function toggleSemesterInput() {
            var roleSelect = document.getElementById('role');
            var semesterInput = document.getElementById('semesterInput');
            if (roleSelect.value === 'Mahasiswa') {
                semesterInput.style.display = 'block';
            } else {
                semesterInput.style.display = 'none';
            }
        }

        function toggleSemesterInputEdit() {
            var roleSelect = document.getElementById('edit-role');
            var semesterInput = document.getElementById('editSemesterInput');
            if (roleSelect.value === 'Mahasiswa') {
                semesterInput.style.display = 'block';
            } else {
                semesterInput.style.display = 'none';
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-user-btn');
        
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name');
                    const userEmail = this.getAttribute('data-email');
                    const userProdiId = this.getAttribute('data-prodi-id');
                    const userRole = this.getAttribute('data-role');
                    const userSemester = this.getAttribute('data-semester');

                    // Mengisi input field dengan nilai dari data atribut
                    document.querySelector('#edit-user-id').value = userId;
                    document.querySelector('#edit-name').value = userName;
                    document.querySelector('#edit-email').value = userEmail;
                    document.querySelector('#edit-prodi').value = userProdiId;
                    document.querySelector('#edit-role').value = userRole;
                    document.querySelector('#edit-semester').value = userSemester;
                    toggleSemesterInputEdit();
                });
                
            });
        });
        
    </script>
@endsection