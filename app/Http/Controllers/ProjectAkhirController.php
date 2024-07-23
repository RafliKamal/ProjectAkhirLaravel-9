<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\tbProdi;
use App\Models\tbMatkul;
use App\Models\tbSoal;
use App\Models\tbUjian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // Import the PDF facade // Tambahkan ini di atas controller Anda
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;


class ProjectAkhirController extends Controller
{
    public function template()
    {
        return view('/template');
    }

    public function master()
    {
        return view('/master');
    }
    public function dashboard()
    {
        $user = auth()->user();

        // Ambil semua ujian dengan id yang dimulai dengan 'T'
        $query = tbUjian::where('ujian_id', 'like', 'T%');

        // Filter data ujian berdasarkan role pengguna
        if ($user->role == 'Dosen') {
            // Untuk dosen, ambil semua mata kuliah yang dimiliki oleh user dan hitung jumlah ujian terkait
            $dataMatkul = tbMatkul::where('user_id', $user->user_id)->get();
            $query->whereIn('matkul_id', $dataMatkul->pluck('matkul_id'));
        } elseif ($user->role == 'Kaprodi') {
            // Untuk kaprodi, ambil semua ujian yang terkait dengan prodi user
            $query->whereHas('matkul', function ($q) use ($user) {
                $q->where('prodi_id', $user->prodi_id);
            });
        }

        // Mendapatkan data ujian
        $dataUjian = $query->get();

        // Menghitung jumlah ujian yang dimiliki oleh user
        $jumlahUjianUser = 0;
        if ($user->role == 'Dosen') {
            $jumlahUjianUser = tbUjian::whereIn('matkul_id', $dataMatkul->pluck('matkul_id'))->count();
        }

        return view('dashboard', [
            'dataUjian' => $dataUjian,
            'jumlahUjianUser' => $jumlahUjianUser
        ]);
    }


    public function cariUjian1(Request $a)
    {
        $user = auth()->user();
        $searchTerm = $a->input('Search');

        // Membuat query untuk mengambil semua ujian yang memiliki ujian_id yang dimulai dengan 'T'
        $query = tbUjian::where('ujian_id', 'like', 'T%');

        // Menambahkan fungsionalitas pencarian
        if (!empty($searchTerm)) {
            $query->whereHas('matkul', function ($q) use ($searchTerm) {
                $q->where('namaMatkul', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter data ujian berdasarkan role pengguna
        if ($user->role == 'Dosen') {
            $dataMatkul = tbMatkul::where('user_id', $user->user_id)->get();
            $query->whereIn('matkul_id', $dataMatkul->pluck('matkul_id'));
        } elseif ($user->role == 'Kaprodi') {
            $query->whereHas('matkul', function ($q) use ($user) {
                $q->where('prodi_id', $user->prodi_id);
            });
        }

        // Mendapatkan data ujian berdasarkan hasil pencarian dan filter
        $dataUjian = $query->get();

        // Menghitung jumlah ujian yang dimiliki oleh user
        $jumlahUjianUser = 0;
        if ($user->role == 'Dosen') {
            $jumlahUjianUser = tbUjian::whereIn('matkul_id', $dataMatkul->pluck('matkul_id'))->count();
        }

        return view('dashboard', [
            'dataUjian' => $dataUjian,
            'jumlahUjianUser' => $jumlahUjianUser
        ]);
    }





    public function login()
    {
        return view('/login');
    }

    //Admin
    public function tbUser()
    {
        $dataUser = User::all();
        $dataProdi = tbProdi::all();
        return view('/admin/tbUser', ['dataUser' => $dataUser, 'dataProdi' => $dataProdi]);
    }
    public function cariUser(request $x)
    {
        $dataProdi = tbProdi::all();
        $cari = $x->cari;
        $dataUser = User::where('name', 'like', '%' . $cari . '%')->get();
        return view('/admin/tbUser', ['dataUser' => $dataUser, 'dataProdi' => $dataProdi]);
    }


    public function tambahUser(Request $a)
    {
        // Generate user_id otomatis
        $lastUser = User::orderBy('user_id', 'desc')->first();
        $nextId = $lastUser ? intval(substr($lastUser->user_id, 1)) + 1 : 1;
        $user_id = 'U' . $nextId;


        // Periksa apakah ID sudah ada, agar tidak terjadi duplikasi id
        while (User::where('user_id', $user_id)->exists()) {
            $nextId++;
            $user_id = 'U' . $nextId;
        }
        // Membuat user baru dengan data yang valid
        $user = User::create([
            'user_id' => $user_id,
            'name' => $a->name,
            'email' => $a->email,
            'password' => Hash::make($a->password),
            'role' => $a->role,
            'prodi_id' => $a->prodi_id,
            'semester' => $a->semester
        ]);

        return redirect('/tbUser')->with('success', 'Data user berhasil ditambahkan');
    }

    public function editUser(Request $a)
    {
        // Validasi data yang masuk
        $validated = $a->validate([
            'user_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string',
            'prodi' => 'required',
            'role' => 'required|string|in:Admin,    Kaprodi,Dosen,Mahasiswa',
            'semester' => 'required_if:role,Mahasiswa'
        ]);



        // Setelah validasi, barulah proses data
        $user = User::find($a->user_id);
        $user->name = $a->name;
        $user->email = $a->email;
        if ($a->password) {
            $user->password = Hash::make($a->password);
        }
        $user->role = $a->role;
        $user->prodi_id = $a->prodi;
        if ($a->role == 'Mahasiswa') {
            $user->semester = $a->semester;
        } else {
            $user->semester = null;
        }

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully!');
    }



    public function hapusUser($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect('/tbUser');
    }

    public function tbMatkul()
    {
        $dataMatkul = tbMatkul::where('matkul_id', 'not like', 'M0')->get();
        $dataProdi = tbProdi::all();
        $dataUser = user::where('role', 'like', '%o%')->get();
        return view('/admin/tbMatkul', ['dataUser' => $dataUser, 'dataProdi' => $dataProdi, 'dataMatkul' => $dataMatkul]);
    }

    public function tambahMatkul(Request $a)
    {
        // Validasi data input
        $a->validate([
            'matkul_id' => 'required|string|max:10',
            'user_id' => 'required',
            'prodi_id' => 'required',
            'namaMatkul' => 'required|string|max:100',
            'semester' => 'required|integer|between:1,8',
        ]);

        // Simpan data ke tabel tbMatkul
        tbMatkul::create([
            'matkul_id' => $a->matkul_id,
            'user_id' => $a->user_id,
            'prodi_id' => $a->prodi_id,
            'namaMatkul' => $a->namaMatkul,
            'semester' => $a->semester
        ]);

        // Redirect ke halaman tbMatkul
        return redirect('/tbMatkul');
    }

    public function updateMatkul(Request $a)
    {
        // Validasi data input
        $a->validate([
            'matkul_id' => 'required|string|max:10',
            'user_id' => 'required',
            'prodi_id' => 'required',
            'namaMatkul' => 'required|string|max:100',
            'semester' => 'required|integer|between:1,8',
        ]);

        // Cari data mata kuliah yang akan diupdate
        $matkul = tbMatkul::find($a->matkul_id);


        // Update data mata kuliah
        $matkul->update([
            'user_id' => $a->user_id,
            'prodi_id' => $a->prodi_id,
            'namaMatkul' => $a->namaMatkul,
            'semester' => $a->semester
        ]);

        // Redirect ke halaman tbMatkul dengan pesan sukses
        return redirect('/tbMatkul')->with('success', 'Data mata kuliah berhasil diupdate.');
    }

    public function hapusMatkul($matkul_id)
    {
        $dataMatkul = tbMatkul::find($matkul_id);
        $dataMatkul->delete();
        return redirect('/tbMatkul');
    }



    //Tabel Prodi
    public function tbProdi()
    {
        $dataProdi = tbProdi::all();
        return view('/admin/tbProdi', ['dataProdi' => $dataProdi]);
    }

    public function tambahProdi(Request $a)
    {
        tbProdi::create([
            'prodi_id' => $a->prodi_id,
            'namaProdi' => $a->namaProdi,
            'namaKaprodi' => $a->namaKaprodi
        ]);
        return redirect('/tbProdi');
    }


    public function editProdi($prodi_id)
    {
        $dataProdi = tbProdi::find($prodi_id);
        return view('/admin/editProdi', ['prodi' => $dataProdi]);
    }

    public function updateProdi($prodi_id, Request $x)
    {
        tbProdi::where('prodi_id', "$prodi_id")->update([
            "namaProdi" => $x->namaProdi,
            "namaKaprodi" => $x->namaKaprodi
        ]);
        return redirect('/tbProdi');
    }

    public function hapusProdi($prodi_id)
    {
        $dataProdi = tbProdi::find($prodi_id);
        $dataProdi->delete();
        return redirect('/tbProdi');
    }


    public function tbSoal()
    {
        $dataSoal = tbSoal::all();
        $dataMatkul = tbMatkul::where('matkul_id', 'not like', 'M0')->get();
        return view('/admin/tbSoal', ['dataSoal' => $dataSoal, 'dataMatkul' => $dataMatkul]);
    }

public function simpanSoal(Request $a)
{
    DB::beginTransaction();
    
    try {
        // Validasi input termasuk validasi untuk filePath yang harus berupa gambar
        $validatedData = $a->validate([
            'matkul_id' => 'required',
            'teksSoal' => 'required|string',
            'filePath' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg' // Validasi file gambar
        ]);

        Log::info('Validasi berhasil', $validatedData);

        $filePath = null; // Inisialisasi $filePath dengan null

        // Cek apakah ada file yang diunggah
        if ($a->hasFile('filePath')) {
            $file = $a->file('filePath');
            // Ambil nama file
            $namaFile = $file->getClientOriginalName();
            // Upload ke folder 
            $file->move('Gambar', $namaFile);
            $filePath = 'Gambar/' . $namaFile;

            Log::info('File berhasil diunggah', ['filePath' => $filePath]);
        }

        // Ambil ID terakhir dari tabel tb_soal
        $lastSoalId = tbSoal::max('soal_id');
        Log::info('ID soal terakhir', ['lastSoalId' => $lastSoalId]);

        // Ambil angka dari soal_id terakhir dan tambahkan 1
        $nextSoalIdNumber = $lastSoalId ? intval(substr($lastSoalId, 1)) + 1 : 1;
        Log::info('Nomor soal ID berikutnya', ['nextSoalIdNumber' => $nextSoalIdNumber]);

        // Format soal_id baru dengan padding nol jika perlu
        $newSoalId = 'S' . str_pad($nextSoalIdNumber, 2, '0', STR_PAD_LEFT);
        Log::info('Soal ID baru', ['newSoalId' => $newSoalId]);

        // Buat entri baru di tabel tb_soal
        tbSoal::create([
            'soal_id' => $newSoalId,
            'matkul_id' => $a->matkul_id,
            'ujian_id' => 'U0',
            'teksSoal' => $a->teksSoal,
            'filePath' => $filePath // Simpan $filePath yang mungkin null
        ]);

        DB::commit();
        Log::info('Data berhasil disimpan', ['soal_id' => $newSoalId]);

        return redirect('/BuatSoal')->with('success', 'Soal berhasil dibuat');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Terjadi kesalahan saat menyimpan data', ['error' => $e->getMessage()]);
        return redirect('/BuatSoal')->with('error', 'Gagal membuat soal. Silakan coba lagi.');
    }
}




    public function updateSoal(Request $a)
    {
        $filePath = $a->input('file_path'); // Ambil filePath yang sudah ada sebelumnya

        // Cek apakah ada file yang diunggah
        if ($a->hasFile('filePath')) {
            $file = $a->file('filePath');
            // Ambil nama file
            $namaFile = $file->getClientOriginalName();
            // Upload ke folder
            $file->move('Gambar', $namaFile);
            $filePath = 'Gambar/' . $namaFile;
        }

        // Cari entri yang akan diupdate
        $soal = tbSoal::find($a->soal_id);

        // Update entri di tabel tb_soal
        $soal->update([
            'matkul_id' => $a->matkul_id,
            'teksSoal' => $a->teksSoal,
            'filePath' => $filePath // Simpan $filePath yang mungkin baru atau lama
        ]);

        return redirect('/tbSoal');
    }
    public function updateSoal2(Request $a)
    {
        $filePath = $a->input('file_path'); // Ambil filePath yang sudah ada sebelumnya

        // Cek apakah ada file yang diunggah
        if ($a->hasFile('filePath')) {
            $file = $a->file('filePath');
            // Ambil nama file
            $namaFile = $file->getClientOriginalName();
            // Upload ke folder
            $file->move('Gambar', $namaFile);
            $filePath = 'Gambar/' . $namaFile;
        }

        // Cari entri yang akan diupdate
        $soal = tbSoal::find($a->soal_id);

        // Update entri di tabel tb_soal
        $soal->update([
            'matkul_id' => $a->matkul_id,
            'teksSoal' => $a->teksSoal,
            'filePath' => $filePath // Simpan $filePath yang mungkin baru atau lama
        ]);

        return redirect('/BankSoal');
    }



    public function tbUjian()
    {
        $dataUjian = tbUjian::Where('ujian_id', 'like', 'T%')->get();
        $dataMatkul = tbMatkul::where('matkul_id', 'not like', 'M0')->get();
        return view('/admin/tbUjian', ['dataUjian' => $dataUjian, 'dataMatkul' => $dataMatkul]);
    }




    public function buatSoal()
    {
        // Ambil peran pengguna yang sedang login
        $userRole = Auth::user()->role;

        // Jika pengguna adalah Dosen
        if ($userRole == 'Dosen' || $userRole == 'Kaprodi') {
            $dataMatkul = tbMatkul::where([
                ['matkul_id', '!=', 'M0'],
                ['user_id', '=', Auth::id()]
            ])->get();
        }
        // Jika pengguna adalah Admin
        else if ($userRole == 'Admin') {
            $dataMatkul = tbMatkul::where('matkul_id', '!=', 'M0')->get();
        }

        $dataSoal = tbSoal::all();
        return view('/admin/buatSoal', ['dataSoal' => $dataSoal, 'dataMatkul' => $dataMatkul]);
    }

    public function bankSoal()
    {
        // Ambil peran pengguna yang sedang login
        $userRole = Auth::user()->role;

        // Jika pengguna adalah Dosen
        if ($userRole == 'Dosen' || $userRole == 'Kaprodi') {
            $dataMatkul = tbMatkul::where([
                ['matkul_id', '!=', 'M0'],
                ['user_id', '=', Auth::id()]
            ])->get();
        }
        // Jika pengguna adalah Admin
        else if ($userRole == 'Admin') {
            $dataMatkul = tbMatkul::where('matkul_id', '!=', 'M0')->get();
        }

        $dataSoal = tbSoal::all();
        return view('/bankSoal', ['dataSoal' => $dataSoal, 'dataMatkul' => $dataMatkul]);
    }



    public function getSoalByMatkul($matkulId)
    {
        $soal = tbSoal::where('matkul_id', $matkulId)->get();
        return response()->json($soal);
    }


    public function hapusSoal($soal_id)
    {
        $data = tbSoal::find($soal_id);
        $data->delete();
        return redirect('/tbSoal');
    }
    public function hapusSoal2($soal_id)
    {
        $data = tbSoal::find($soal_id);
        $data->delete();
        return redirect('/BankSoal');
    }



// Controller function modifications
public function buatUjian(Request $a)
{
    // Ambil peran pengguna yang sedang login
    $userRole = Auth::user()->role;

    // Inisialisasi variabel data matkul dan ujian
    $dataMatkul = collect();
    $dataUjian = collect();

    // Jika pengguna adalah Dosen
    if ($userRole == 'Dosen' || $userRole == 'Kaprodi') {
        $dataMatkul = tbMatkul::where([
            ['matkul_id', '!=', 'M0'],
            ['user_id', '=', Auth::id()]
        ])->get();

        $matkulIds = $dataMatkul->pluck('matkul_id');
        $dataUjian = tbUjian::whereIn('matkul_id', $matkulIds)->where('ujian_id', '!=', 'U0')->get();
    }
    // Jika pengguna adalah Admin
    else if ($userRole == 'Admin') {
        $dataMatkul = tbMatkul::where('matkul_id', '!=', 'M0')->get();
        $dataUjian = tbUjian::where('ujian_id', '!=', 'U0')->get();
    }

    return view('/admin/buatUjian', ['dataMatkul' => $dataMatkul, 'dataUjian' => $dataUjian]);
}

public function buatUjian2(Request $a)
{
    $matkul_id = $a->input('matkul');
    $dataMatkul = tbMatkul::where('matkul_id', $matkul_id)->firstOrFail(); // Menggunakan firstOrFail
    $dataSoal = tbSoal::where('matkul_id', $matkul_id)->where('ujian_id', 'U0')->get();
    return view('/admin/buatUjian2', ['dataSoal' => $dataSoal, 'dataMatkul' => $dataMatkul]);
}

public function simpanUjian(Request $a)
{
    $validatedData = $a->validate([
        'matkul_id' => 'required',
        'tanggal' => 'required|date',
        'jenisUjian' => 'required',
        'tipeSoal' => 'required',
        'sifatUjian' => 'required',
        'durasiUjian' => 'required',
        'tahunAkademik' => 'required',
        'soal' => 'required|array',
    ]);

    // Generate ujian_id otomatis
    $lastUjian = tbUjian::orderBy('ujian_id', 'desc')->first();
    $nextId = $lastUjian ? intval(substr($lastUjian->ujian_id, 1)) + 1 : 1;
    $ujian_id = 'T' . $nextId;

    // Check if the generated ID already exists to avoid duplicates
    while (tbUjian::where('ujian_id', $ujian_id)->exists()) {
        $nextId++;
        $ujian_id = 'T' . $nextId;
    }

    // Create tbUjian
    tbUjian::create([
        'ujian_id' => $ujian_id,
        'matkul_id' => $a->matkul_id,
        'tanggalUjian' => $a->tanggal,
        'jenisUjian' => $a->jenisUjian,
        'tipeSoal' => $a->tipeSoal,
        'sifatUjian' => $a->sifatUjian,
        'durasiUjian' => $a->durasiUjian,
        'tahunAkademik' => $a->tahunAkademik,
        'status' => 'Menunggu Review',
        'komentar' => '',
    ]);

    // Update ujian_id in tbSoal
    foreach ($a->soal as $soal_id) {
        tbSoal::where('soal_id', $soal_id)->update(['ujian_id' => $ujian_id]);
    }

    return redirect('/BuatUjian')->with('success', 'Ujian berhasil disimpan!');
}


    public function hapusUjian($ujian_id)
    {
        $data = tbUjian::find($ujian_id);
        $data->delete();
        return redirect('/tbUjian');
    }


    public function ujian()
    {
        $user = Auth::user();
        $role = $user->role;
        $ujian = collect();
    
        if ($role == 'Mahasiswa') {
            // Jika role adalah Mahasiswa
            $ujian = tbUjian::whereHas('matkul', function ($query) use ($user) {
                $query->where('prodi_id', $user->prodi_id)
                    ->where('semester', $user->semester);
            })->where('status', 'Disetujui')->with('matkul.prodi')->get();
        } elseif ($role == 'Dosen') {
            // Jika role adalah Dosen
            $ujian = tbUjian::whereHas('matkul', function ($query) use ($user) {
                $query->where('user_id', $user->user_id);
            })->where('status', 'Disetujui')->with('matkul.prodi')->get();
        } elseif ($role == 'Kaprodi') {
            // Jika role adalah Kaprodi
            $ujian = tbUjian::whereHas('matkul', function ($query) use ($user) {
                $query->where('prodi_id', $user->prodi_id);
            })->where('status', 'Disetujui')->with('matkul.prodi')->get();
        } elseif ($role == 'Admin') {
            // Jika role adalah Admin
            $ujian = tbUjian::where('ujian_id', '!=', 'U0')
                ->where('status', 'Disetujui')
                ->with('matkul.prodi')
                ->get();
        }
    
        $soal = tbSoal::whereIn('ujian_id', $ujian->pluck('ujian_id'))->get(); // Ambil semua soal yang terkait dengan ujian
        return view('/lihatUjian', ['dataUjian' => $ujian, 'dataSoal' => $soal]);
    }
    
    


    public function ujian2($ujian_id)
{
    $ujian = tbUjian::where('ujian_id', $ujian_id)->with('matkul.prodi', 'matkul.user')->get();
    $soal = tbSoal::where('ujian_id', $ujian_id)->get();
    return view('/lihatUjian2', ['dataUjian' => $ujian, 'dataSoal' => $soal]);
}



    public function generatePDF($ujian_id)
    {
        $ujian = tbUjian::where('ujian_id', $ujian_id)->get();
        $soal = tbSoal::where('ujian_id', $ujian_id)->get();

        $pdf = Pdf::loadView('lihatUjian2pdf', ['dataUjian' => $ujian, 'dataSoal' => $soal]);
        return $pdf->download('ujian.pdf');
    }

    public function reviewUjian()
    {
        $user = auth()->user();

        // Membuat query untuk mengambil semua ujian yang berstatus 'Menunggu Review'
        $query = tbUjian::where('status', 'Menunggu Review');

        // Filter data ujian berdasarkan prodi user jika user adalah kaprodi
        if ($user->role == 'Kaprodi') {
            $query->whereHas('matkul', function ($q) use ($user) {
                $q->where('prodi_id', $user->prodi_id);
            });
        }

        // Mendapatkan data ujian berdasarkan filter
        $ujian = $query->get();

        return view('/admin/reviewUjian', ['dataUjian' => $ujian]);
    }


    public function reviewUjian2($ujian_id)
    {
        $ujian = tbUjian::where('ujian_id', $ujian_id)->get();
        $soal = tbSoal::where('ujian_id', $ujian_id)->get();
        return view('/admin/reviewUjian2', ['dataUjian' => $ujian, 'dataSoal' => $soal]);
    }

    public function simpanReview($ujian_id, Request $a)
    {

        tbUjian::where("ujian_id", "$ujian_id")->update([
            'status' => $a->status,
            'komentar' => $a->komentar
        ]);
        return redirect('/dashboard');
    }

    public function revisiUjian($ujian_id)
    {
        $ujian = tbUjian::where('ujian_id', $ujian_id)->first(); // Mengambil satu data ujian
        $soalUjian = tbSoal::where('ujian_id', $ujian_id)->get(); // Mengambil semua soal terkait ujian
        $soalKeseluruhan = tbSoal::where('matkul_id', $ujian->matkul_id)->get(); // Mengambil semua soal terkait ujian
        $dataMatkul = tbMatkul::all(); // Mengambil semua data mata kuliah

        // Format tanggal menjadi 'Y-m-d'
        $ujian->formattedTanggalUjian = Carbon::parse($ujian->tanggalUjian)->format('Y-m-d');

        return view('/revisiUjian', [
            'dataUjian' => $ujian,
            'dataSoalUjian' => $soalUjian,
            'dataSoalKeseluruhan' => $soalKeseluruhan,
            'dataMatkul' => $dataMatkul
        ]);
    }

    public function simpanRevisi(Request $a)
    {
        // Validasi input
        $a->validate([
            'ujian_id' => 'required',
            'tanggal' => 'required|date',
            'jenisUjian' => 'required|string',
            'tipeSoal' => 'required|string',
            'sifatUjian' => 'required|string',
            'durasiUjian' => 'required|string',
            'tahunAkademik' => 'required|string',
            'soal' => 'required|array',

        ]);

        // Cari ujian berdasarkan ujian_id
        $ujian = tbUjian::find($a->ujian_id);

        // Update data ujian
        $ujian->tanggalUjian = $a->tanggal;
        $ujian->jenisUjian = $a->jenisUjian;
        $ujian->tipeSoal = $a->tipeSoal;
        $ujian->sifatUjian = $a->sifatUjian;
        $ujian->durasiUjian = $a->durasiUjian;
        $ujian->tahunAkademik = $a->tahunAkademik;
        $ujian->status = 'Menunggu Review';
        $ujian->save();

        // Perbarui kolom ujian_id pada soal yang dipilih
        $selectedSoalIds = $a->soal;
        tbSoal::where('ujian_id', $ujian->ujian_id)
            ->whereNotIn('soal_id', $selectedSoalIds)
            ->update(['ujian_id' => 'U0']);

        foreach ($selectedSoalIds as $soal_id) {
            $soal = tbSoal::find($soal_id);
            $soal->ujian_id = $ujian->ujian_id;
            $soal->save();
        }
        return redirect('/dashboard');
    }
}
