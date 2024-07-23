@extends('/master')

@section('title')
    Review Ujian
@endsection


@section('halaman_utama')
<div class="row">
        @foreach ($dataUjian as $x)
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{$x->matkul->namaMatkul}}</h3>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-muted font-weight-normal mt-2">{{$x->matkul->user->name}} </h4>                    
                    <h5 class="text-muted font-weight-normal mt-2">{{$x->jenisUjian}} - Semester {{$x->matkul->semester}}</h5>                    
                    <a href="ReviewUjian2/{{$x->ujian_id}}" type="submit" class="btn btn-primary mt-3">Review</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
