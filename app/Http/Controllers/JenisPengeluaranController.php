<?php

namespace App\Http\Controllers;

use App\Models\JenisPengeluaran;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $data = [
            'jenis_pemasukan' => JenisPengeluaran::all()
        ];

        return view('dashboard.jenis-pengeluaran.index', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_pengeluaran' => ['required', 'max:40']
        ]);

        if ($data) {
            if ($request->input('id') !== null) {
                // TODO: Update Jenis Surat
                $jenis_pengeluaran = JenisPengeluaran::query()->find($request->input('id'));
                $jenis_pengeluaran->fill($data);
                $jenis_pengeluaran->save();

                return response()->json([
                    'message' => 'Jenis pengeluaran berhasil diupdate!'
                ], 200);
            }

            $dataInsert = JenisPengeluaran::create($data);
            if ($dataInsert) {
                return redirect()->to('/dashboard/pengeluaran/jenis')->with('success', 'Jenis pengeluaran berhasil ditambah');
            }
        }

        return redirect()->to('/dashboard/pengeluaran/jenis')->with('error', 'Gagal tambah data');
    }

    public function delete(int $id): JsonResponse
    {
        $jenis_pengeluaran = JenisPengeluaran::query()->find($id)->delete();

        if ($jenis_pengeluaran):
            //Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan' => 'Data user berhasil dihapus'
            ];
        else:
            //Pesan Gagal
            $pesan = [
                'success' => false,
                'pesan' => 'Data gagal dihapus'
            ];
        endif;
        return response()->json($pesan);
    }
}
