<?php

namespace App\Http\Controllers;

use App\Charts\JenisPemasukantChart;
use App\Charts\JeniasPengeluaranChart;
use App\Charts\PemasukanChart;
use App\Charts\PengeluaranChart;
use App\Charts\DonaturChart;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(JenisPemasukanChart $jpChart, PemasukanChart $pemasukanChart) {
        $data = [
            'user' => User::query()->count(),
            'jenis_pemasukan' => JenisPemasukan::query()->count(),
            'pemasukan' => Pemasukan::query()->count(),
            'log' => Log::query()->count(),
            'jpChart' => $jpChart->build(),
            'pemasukanChart' => $pemasukanChart->build()
        ];

        return view('dashboard.index', $data);
    }

    public function jenispengeluaran(JenisPengeluaranChart $jpChart, PengeluaranChart $pengeluaranChart) {
        $data = [
            'user' => User::query()->count(),
            'jenis_pengeluaran' => JenisPengeluaran::query()->count(),
            'pengeluaran' => Pengeluaran::query()->count(),
            'log' => Log::query()->count(),
            'jpChart' => $jpChart->build(),
            'pengeluaranChart' => $pengeluaranChart->build()
        ];

        return view('dashboard.index', $data);
    }

    public function pemasukan(PemasukanChartChart $PChart, PemasukanChart $pemasukanChart) {
        $data = [
            'user' => User::query()->count(),
            'pemasukan' => Pemasukan::query()->count(),
            'pemasukan' => Pemasukan::query()->count(),
            'log' => Log::query()->count(),
            'PChart' => $PChart->build(),
            'pemasukanChart' => $pemasukanChart->build()
        ];

        return view('dashboard.index', $data);
    }

    public function pengeluaran(PengeluaranChartChart $PChart, PengeluaranChart $pengeluaranChart) {
        $data = [
            'user' => User::query()->count(),
            'pengeluaran' => Pengeluaran::query()->count(),
            'pengeluaran' => Pengeluaran::query()->count(),
            'log' => Log::query()->count(),
            'PChart' => $PChart->build(),
            'pengeluaranChart' => $pengeluaranChart->build()
        ];

        return view('dashboard.index', $data);
    }

    public function donatur(DonaturChartChart $Dhart, DonaturChart $donaturChart) {
        $data = [
            'user' => User::query()->count(),
            'donatur' => Donatur::query()->count(),
            'donatur' => Donatur::query()->count(),
            'log' => Log::query()->count(),
            'Dhart' => $Dhart->build(),
            'DonaturChart' => $donaturChart->build()
        ];

        return view('dashboard.index', $data);
    }
}
