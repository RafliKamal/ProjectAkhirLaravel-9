@extends('/master')

@section('title')
    Edit User
@endsection

@section('halaman_utama')
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="/editUser" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="">

                    <div class="form-group">
                        <label for="nama" class="mt-3 mb-2">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            placeholder="Nama User" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="mt-3 mb-2">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="Email User" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="mt-3 mb-2">Password</label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Password User" name="password"
                            value="{{ old('password') }}">
                        @error('password')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prodi" class="mt-3 mb-2">Prodi</label>
                        <select class="form-select @error('prodi') is-invalid @enderror" aria-label="Pilih Prodi" name="prodi" id="prodi">
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
                            name="role" id="role" value="{{ old('role') }}">
                            <option value="" disabled selected hidden>Pilih Role</option>
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
                    <button type="submit" class="btn btn-primary me-2 mt-3">Submit</button>
                    <button type="button" class="btn btn-light mt-3" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
