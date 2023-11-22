<?php

namespace App\Http\Controllers;

use App\Models\JenisPemasukan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $data = [
            'jenis_pemasukan' => JenisPemasukan::all()
        ];

        return view('jenis_pemasukan.index', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_pemasukan' => ['required', 'max:40']
        ]);

        if ($data) {
            if ($request->input('id') !== null) {
                // TODO: Update Jenis Surat
                $jenis_pemasukan = JenisPemasukan::query()->find($request->input('id'));
                $jenis_pemasukan->fill($data);
                $jenis_pemasukan->save();

                return response()->json([
                    'message' => 'Jenis pemasukan berhasil diupdate!'
                ], 200);
            }

            $dataInsert = JenisPemasukan::create($data);
            if ($dataInsert) {
                return redirect()->to('/dashboard/pemasukan/jenis')->with('success', 'Jenis pemasukan berhasil ditambah');
            }
        }

        return redirect()->to('/dashboard/pemasukan/jenis')->with('error', 'Gagal tambah data');
    }

    public function delete(int $id): JsonResponse
    {
        $jenis_pemasukan = JenisPemasukan::query()->find($id)->delete();

        if ($jenis_pemasukan):
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
