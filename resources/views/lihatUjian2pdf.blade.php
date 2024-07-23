<!DOCTYPE html>
<html>
<head>
    <title>Soal Ujian</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-table {
            width: 100%;
            border: 1px solid black;
            text-align: center;
            margin-bottom: 20px;
        }
        .header-table td, .header-table th {
            padding: 10px;
            vertical-align: middle;
        }
        .header-logo {
            width: 150px;
            height: auto;
        }
        .table-info th, .table-info td {
            padding: 10px;
            border: none;
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
            text-align: center;
            margin-top: 10px;
        }
        .print-button {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body> 
    @foreach ($dataUjian as $x)
    <div class="header">
        <table class="header-table">
            <tr>
                <td rowspan="3" style="width: 150px;">
                    <img src="https://045042.sgp1.digitaloceanspaces.com/sikad/gambar/Logo.MtOnvco5l0.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&amp;X-Amz-Credential=DO00HKV7BJTGPCB4T4BN%2F20240723%2Fsgp1%2Fs3%2Faws4_request&amp;X-Amz-Date=20240723T074859Z&amp;X-Amz-Expires=86400&amp;X-Amz-SignedHeaders=host&amp;x-id=GetObject&amp;X-Amz-Signature=c0482e9c68c572de00f3c3048a94e9dc4a8be9b16439d1bec8f033d3e20a7d5c" class="header-logo">
                </td>
                <td colspan="2"><h2>JURUSAN {{$x->matkul->prodi->namaProdi}}</h2></td>
                <td rowspan="3" style="width: 50px;"><strong>EVA</strong></td>
            </tr>
            <tr>
                <td colspan="2"><h3>POLITEKNIK ENJINERING INDORAMA</h3></td>
            </tr>
            <tr>
                <td colspan="2"><h4>SOAL {{$x->jenisUjian}}</h4></td>
            </tr>
        </table>
    </div>

    <div class="container mt-5">
        <table class="table table-borderless table-info">
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
                <img src="{{ asset($s->filePath) }}" class="img-fluid" alt="Soal Image">
            </div>
            @endif
        </div>
    @endforeach

    <div class="print-button">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>
    </div>
</body>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
