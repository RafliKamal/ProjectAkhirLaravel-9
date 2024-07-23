<!DOCTYPE html>
<html>
<head>
    <title>Soal Ujian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            
        }
        .header .title {
            text-align: center;
            flex-grow: 1;
        }
        .header .eva {
            text-align: center;
            padding: 0 10px;
        }
        .table {
            margin-top: 20px;
        }
        .print-button {
            position: fixed;
            top: 90px;
            right:  5%;
            transform: translateX(-50%);
            text-align: center;
        }
        .soal-container {
            margin-bottom: 20px;
        }
        .soal-number {
            width: 30px;
            text-align: center;
        }
        .soal-text {
            flex-grow: 1;
            padding-left: 10px;
        }
        .soal-image {
            margin-left: 40px;
            margin-top: 10px;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body> 
    @foreach ($dataUjian as $x)
    <div class="header container">
        <table class="table table-bordered">
            <tr>
                <td class="align-middle mx-auto">
                    <img src="https://045042.sgp1.digitaloceanspaces.com/sikad/gambar/Logo.MtOnvco5l0.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&amp;X-Amz-Credential=DO00HKV7BJTGPCB4T4BN%2F20240723%2Fsgp1%2Fs3%2Faws4_request&amp;X-Amz-Date=20240723T074859Z&amp;X-Amz-Expires=86400&amp;X-Amz-SignedHeaders=host&amp;x-id=GetObject&amp;X-Amz-Signature=c0482e9c68c572de00f3c3048a94e9dc4a8be9b16439d1bec8f033d3e20a7d5c" alt="Logo">
                </td>
                <td class="align-middle">
                    <div class="title">
                        <h4><strong>JURUSAN {{$x->matkul->prodi->namaProdi}}
                            </strong> </h4>
                        <h4><strong>POLITEKNIK ENJINERING INDORAMA
                            </strong> </h4>
                        <hr>
                        <h4><strong> SOAL {{$x->jenisUjian}}</strong></h4>
                    </div>
                </td>
                <td class="align-middle">
                    <div class="eva">
                        <h2><strong>EVA</strong></h2>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        <table class="table table-borderless ">
            <tr>
                <th>Mata Kuliah</th>
                <td>{{ $x->matkul->namaMatkul }}</td>
                <th>Sifat Ujian</th>
                <td>{{ $x->sifatUjian }}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{$x->matkul->prodi->namaProdi}}</td>
                <th>Tahun Akademik</th>
                <td>{{ $x->tahunAkademik }}</td>
            </tr>
            <tr>
                <th>Hari / Tanggal</th>
                <td>{{ $x->tanggalUjian }}</td>
                <th>Semester</th>
                <td>{{ $x->matkul->semester }}</td>
            </tr>
            <tr>
                <th>Waktu</th>
                <td>{{$x->durasiUjian}}</td>
                <th>Dosen</th>
                <td>{{$x->matkul->user->name}}</td>
            </tr>
        </table>
    @endforeach

    @foreach ($dataSoal as $index => $s)
        <div class="soal-container">
            <div class="d-flex align-items-start">
                <div class="soal-number">{{ $index + 1 }}</div>
                <div class="soal-text">
                    <h5>{{ $s->teksSoal }}</h5>
                </div>
            </div>
            @if ($s->filePath)
            <div class="soal-image">
                <img src="{{ asset($s->filePath) }}" width="300px">
            </div>
            @endif
        </div>
    @endforeach

    <div class="print-button">
        <button onclick="window.print()" class="btn btn-success">Print Soal</button>
    </div>
    </div>
</body>
</html>
