<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BerandaController extends Controller
{
    public function berandaBackend()
    {
        $allBulan = [
            1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',
            7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
        ];

        // Barang Masuk
        $masukRaw = BarangMasuk::select(
                DB::raw("MONTH(tanggal_masuk) AS bulan_num"), // 1,2,3...
                DB::raw("SUM(jumlah_masuk) AS total")
            )
            ->groupBy('bulan_num')
            ->orderBy('bulan_num')
            ->pluck('total','bulan_num')   // key = bulan_num, value = total
            ->toArray();

        // Buat array lengkap untuk semua bulan
        $masuk = [];
        foreach($allBulan as $num => $nama){
            $masuk[$nama] = $masukRaw[$num] ?? 0;  // kalau bulan tidak ada data, 0
        }

        // Barang Keluar
        $keluarRaw = BarangKeluar::select(
                DB::raw("MONTH(tanggal_keluar) AS bulan_num"),
                DB::raw("SUM(jumlah_keluar) AS total")
            )
            ->groupBy('bulan_num')
            ->orderBy('bulan_num')
            ->pluck('total','bulan_num')
            ->toArray();

        $keluar = [];
        foreach($allBulan as $num => $nama){
            $keluar[$nama] = $keluarRaw[$num] ?? 0;
        }

        $totalStok = Produk::sum('stok');
        $totalMasuk = BarangMasuk::sum('jumlah_masuk');
        $totalKeluar = BarangKeluar::sum('jumlah_keluar');
        // $totalStok = $totalMasuk - $totalKeluar;
        $produkSedikit = Produk::orderBy('stok', 'asc')->first();


        $tanggalSekarang = Carbon::today();
        $produk = Produk::where('kadaluarsa' , '>=' , $tanggalSekarang)->orderBy('kadaluarsa' , 'asc')->limit(3)->get();

        return view('backend.v_beranda.index' , [
            'judul' => 'Halaman Dashboard',
            'totalStok' => $totalStok,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'produkSedikit' => $produkSedikit,
            'masuk' => $masuk,
            'keluar' => $keluar,
            'produk' => $produk
        ]);
    }

    // public function produkKadaluarsa()
    // {
    //     $hariLimit = 7;
    //     $tanggalSekarang = Carbon::today();
    //     $tanggalBatas = $tanggalSekarang->copy()->addDays($hariLimit);

    //     $produk = Produk::whereBetween('kadaluarsa' , [$tanggalSekarang , $tanggalBatas])->orderBy('kadaluarsa' , 'asc')->limit(3)->get();

    //     return view('backend.v_beranda.index' , compact('produk'));
    // }

}
