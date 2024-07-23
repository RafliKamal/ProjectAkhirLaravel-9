@extends('/master')

@section('title')
    Dashboard
@endsection

@section('halaman_utama')
    @auth
        {{-- Tampilan untuk role admin --}}
        @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Kaprodi')
            <div class="row">
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body btn-inverse-info">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">{{ $dataUjian->count() }}</h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-info ">
                                        <span class="mdi mdi-file-document icon-item"></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">Jumlah Ujian</h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body btn-inverse-warning">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">{{ $dataUjian->where('status', 'Menunggu Review')->count() }}</h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-warning ">
                                        <span class="mdi mdi-alert-outline icon-item"></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">Belum Direview</h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body btn-inverse-danger">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">{{ $dataUjian->where('status', 'Revisi')->count() }}</h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-danger ">
                                        <span class="mdi mdi-pencil-box-outline icon-item"></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">Sedang Direvisi</h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body btn-inverse-success">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">{{ $dataUjian->where('status', 'Disetujui')->count() }}</h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                        <span class="mdi mdi-checkbox-marked-outline icon-item"></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">Telah Disetujui</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-between">
                                <h4 class="card-title mb-1">Lihat Soal Ujian</h4>
                                <p class="text-muted mb-1">Your data status</p>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list">
                                        @foreach ($dataUjian as $u)
                                            <div class="preview-item border-bottom">
                                                <div class="preview-thumbnail">
                                                    <div class="preview-icon bg-primary">
                                                        <i class="mdi mdi-file-document"></i>
                                                    </div>
                                                </div>
                                                <div class="preview-item-content d-sm-flex flex-grow">
                                                    <div class="flex-grow">
                                                        <h6 class="preview-subject">{{ $u->matkul->namaMatkul }}</h6>
                                                        <p class="text-muted mb-0">{{ $u->jenisUjian }}</p>
                                                        <p class=" @if($u->status == 'Revisi') text-danger @elseif($u->status == 'Disetujui')  text-success @elseif($u->status == 'Menunggu Review')  text-warning @endif mb-0 ">{{ $u->status }}</p>
                                                    </div>
                                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                        <a href="lihatUjian2/{{ $u->ujian_id }}" class="btn btn-lg btn-primary mt-3 me-1">Lihat</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-8">
                                    <h4 class="card-title">Data Ujian</h4>
                                </div>
                                <div class="col-4 container-fluid">
                                    <form class="d-flex" role="search" method="GET" action="/cariUjian1">
                                        {{ csrf_field() }}
                                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="Search">
                                        <button class="btn btn-outline-info" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                           
                                            <th> Ujian_Id </th>
                                            <th> Nama Mata Kuliah </th>
                                            <th> Tanggal Ujian </th>
                                            <th> Tipe Soal </th>
                                            <th> Durasi Ujian </th>
                                            <th> Jenis Ujian </th>
                                            <th> Sifat Ujian </th>
                                            <th> Tahun Akademik </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataUjian as $ujian)
                                            <tr>
                                                
                                                <td> {{$ujian->ujian_id}} </td>
                                                <td> {{$ujian->matkul->namaMatkul}}</td>
                                                <td> {{$ujian->tanggalUjian}}</td>
                                                <td> {{$ujian->tipeSoal}} </td>
                                                <td> {{$ujian->durasiUjian}} </td>
                                                <td> {{$ujian->jenisUjian}} </td>
                                                <td> {{$ujian->sifatUjian}} </td>
                                                <td> {{$ujian->tahunAkademik}} </td>
                                                <td>
                                                    @if($ujian->status == 'Disetujui')
                                                    <div class="badge badge-outline-success">
                                                        {{$ujian->status}}
                                                    </div>
                                                    @elseif($ujian->status == 'Menunggu Review')
                                                    <div class="badge badge-outline-warning">
                                                        {{$ujian->status}}
                                                    </div>
                                                    @elseif($ujian->status == 'Revisi')
                                                    <div class="badge badge-outline-danger">
                                                        {{$ujian->status}}
                                                    </div>
                                                    @else
                                                    <div class="badge badge-outline-info">
                                                        {{$ujian->status}}
                                                    </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="/revisiUjian/{{$ujian->ujian_id}}" type="button" class="btn btn-outline-warning px-3">Edit</a>
                                                    <a href="/hapusUjian/{{$ujian->ujian_id}}" type="button" class="btn btn-outline-danger btn-lg me-1">Hapus</a>
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
        @endif

        {{-- Tampilan untuk role dosen --}}
        @if (auth()->user()->role == 'Dosen')
            <div class="row">
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body btn-inverse-info">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">{{ $jumlahUjianUser }}</h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-info ">
                                        <span class="mdi mdi-file-document icon-item"></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">Jumlah Ujian</h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body btn-inverse-warning">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">
                                            {{ $dataUjian->where('status', 'Menunggu Review')->filter(fn($u) => $u->matkul->user_id == auth()->user()->user_id)->count() }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-warning ">
                                        <span class="mdi mdi-alert-outline icon-item"></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">Belum Direview</h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body btn-inverse-danger">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">
                                            {{ $dataUjian->where('status', 'Revisi')->filter(fn($u) => $u->matkul->user_id == auth()->user()->user_id)->count() }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-danger ">
                                        <span class="mdi mdi-pencil-box-outline icon-item"></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">Sedang Direvisi</h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body btn-inverse-success">
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">
                                            {{ $dataUjian->where('status', 'Disetujui')->filter(fn($u) => $u->matkul->user_id == auth()->user()->user_id)->count() }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                        <span class="mdi mdi-checkbox-marked-outline icon-item"></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">Telah Disetujui</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-between">
                                <h4 class="card-title mb-1">Lihat Soal Ujian</h4>
                                <p class="text-muted mb-1">Your data status</p>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list">
                                        @foreach ($dataUjian->filter(fn($u) => $u->matkul->user_id == auth()->user()->user_id) as $u)
                                            <div class="preview-item border-bottom">
                                                <div class="preview-thumbnail">
                                                    <div class="preview-icon bg-primary">
                                                        <i class="mdi mdi-file-document"></i>
                                                    </div>
                                                </div>
                                                <div class="preview-item-content d-sm-flex flex-grow">
                                                    <div class="flex-grow">
                                                        <h6 class="preview-subject">{{ $u->matkul->namaMatkul }}</h6>
                                                        <p class="text-muted mb-3">{{ $u->jenisUjian }}</p>
                                                        <p class="text-muted">Status : <span class=" @if($u->status == 'Revisi') text-danger @elseif($u->status == 'Disetujui')  text-success @elseif($u->status == 'Menunggu Review')  text-warning @endif mb-0 ">{{ $u->status }}</span> </p>
                                                    </div>
                                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                        <a href="lihatUjian2/{{ $u->ujian_id }}" class="btn btn-lg btn-primary mt-3 me-1">Lihat</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-8">
                                    <h4 class="card-title">Data Ujian</h4>
                                </div>
                                <div class="col-4 container-fluid">
                                    <form class="d-flex" role="search" method="GET" action="/cariUjian1">
                                        {{ csrf_field() }}
                                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="Search">
                                        <button class="btn btn-outline-info" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                           
                                            <th> Ujian_Id </th>
                                            <th> Nama Mata Kuliah </th>
                                            <th> Tanggal Ujian </th>
                                            <th> Tipe Soal </th>
                                            <th> Durasi Ujian </th>
                                            <th> Jenis Ujian </th>
                                            <th> Sifat Ujian </th>
                                            <th> Tahun Akademik </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataUjian->filter(fn($u) => $u->matkul->user_id == auth()->user()->user_id) as $ujian)
                                            <tr>
                                                
                                                <td> {{$ujian->ujian_id}} </td>
                                                <td> {{$ujian->matkul->namaMatkul}}</td>
                                                <td> {{$ujian->tanggalUjian}}</td>
                                                <td> {{$ujian->tipeSoal}} </td>
                                                <td> {{$ujian->durasiUjian}} </td>
                                                <td> {{$ujian->jenisUjian}} </td>
                                                <td> {{$ujian->sifatUjian}} </td>
                                                <td> {{$ujian->tahunAkademik}} </td>
                                                <td>
                                                    @if($ujian->status == 'Disetujui')
                                                    <div class="badge badge-outline-success">
                                                        {{$ujian->status}}
                                                    </div>
                                                    @elseif($ujian->status == 'Menunggu Review')
                                                    <div class="badge badge-outline-warning">
                                                        {{$ujian->status}}
                                                    </div>
                                                    @elseif($ujian->status == 'Revisi')
                                                    <div class="badge badge-outline-danger">
                                                        {{$ujian->status}}
                                                    </div>
                                                    @else
                                                    <div class="badge badge-outline-info">
                                                        {{$ujian->status}}
                                                    </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="/revisiUjian/{{$ujian->ujian_id}}" type="button" class="btn btn-outline-warning px-3">Edit</a>
                                                    <a href="/hapusUjian/{{$ujian->ujian_id}}" type="button" class="btn btn-outline-danger btn-lg me-1">Hapus</a>
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
        @endif

    @endauth
@endsection
