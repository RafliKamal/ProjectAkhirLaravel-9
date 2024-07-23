@extends('/master')

@section('title')
    Table Prodi
@endsection

@section('halaman_utama')
     <!-- Button trigger modal tambah data-->
     <button type="button" class="btn btn-social-icon-text btn-facebook mb-4" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
        <i class="ti-plus"></i>Tambah Data
    </button>

    <!-- Modal tambah data-->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Prodi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="/simpanProdi" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputUsername1" class="mt-3 mb-2">Prodi ID</label>
                            <input type="text" class="form-control @error('prodi_id') is-invalid @enderror" id="exampleInputUsername1" placeholder="ID" name="prodi_id" >
                            @error('user_id')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Prodi</label>
                            <input type="text" class="form-control @error('namaProdi') is-invalid @enderror" id="exampleInputEmail1" placeholder="Nama Prodi" name="namaProdi">
                            @error('namaProdi')
                            <div class="invalid-feedback" style="font-size: 13px;">
                                {{ $message }}
                                <br>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mt-3 mb-2">Nama Kaprodi</label>
                            <input type="text" class="form-control @error('namaKaprodi') is-invalid @enderror" id="exampleInputEmail1" placeholder="Nama Kaprodi" name="namaKaprodi" >
                            @error('namaKaprodi')
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
                        <h4 class="card-title">Data Prodi</h4>
                    </div>
                    
                </div>
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                              
                                <th> Prodi_Id </th>
                                <th> Nama Prodi </th>
                                <th> Nama Kaprodi </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataProdi as $x)
                            <tr>
                               
                                <td> {{$x->prodi_id}} </td>
                                <td> {{$x->namaProdi}} </td>
                                <td> {{$x->namaKaprodi}} </td>
                                <td>
                                    <a href="/editProdi/{{$x->prodi_id}}" class="btn btn-outline-warning px-3">Edit</a>
                                    <a href="/hapusProdi/{{$x->prodi_id}}" type="button" class="btn btn-outline-danger btn-lg me-1">Hapus</a>
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
