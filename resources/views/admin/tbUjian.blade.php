@extends('/master')

@section('title')
    Table Ujian
@endsection

@section('halaman_utama')

    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-8">
                            <h4 class="card-title">Data Ujian</h4>
                        </div>
                       
                    </div>
                    <div class="table-responsive">
                        <table class="table text-center ">
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
                                        <a href="/revisiUjian/{{$ujian->ujian_id}}" type="button" class="btn btn-outline-warning px-3"
                                            >Edit</a>
                                        <a href="/hapusUjian/{{$ujian->ujian_id}}" type="button"
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
@endsection
