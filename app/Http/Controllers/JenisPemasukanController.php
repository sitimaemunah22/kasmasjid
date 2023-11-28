<?php

namespace App\Http\Controllers;

use App\Http\JenisPemasukan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JenisPemasukanController extends Controller
{
    // public function index()
    // {
    //     $data = [
    //         'jenis_pemasukan' => JenisPemasukan::all()
    //     ];

    //     return view('jenispemasukan.index', $data);
    // }

    public function index()
{
    $data = JenisPemasukan::all();
    return view('dashboard.JenisPemasukan.index', compact('data'));
}
    public function store(Request $request)
    {
        $data = $request->validate([
            'jenispemasukan' => ['required', 'max:40']
        ]);

        if ($data) {
            if ($request->input('id') !== null) {
                // TODO: Update Jenis Surat
                $JenisPemasukan = JenisPemasukan::query()->find($request->input('id'));
                $JenisPemasukan->fill($data);
                $JenisPemasukan->save();

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
        $JenisPemasukan = JenisPemasukan::query()->find($id)->delete();

        if ($JenisPemasukan):
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
