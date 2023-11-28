<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengeluaranCreateRequest;
use App\Http\Requests\PengeluaranUpdateRequest;
use App\Models\JenisPengeluaran;
use App\Models\pengeluaran;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengeluaranController extends Controller
{
    // public function index(): View
    // {
    //     $data = [
    //         'pengeluaran' => Pengeluaran::with('jenis', 'user')->orderByDesc('tanggal_pengeluaran')->get(),
    //         'jenis_pemasukan' => JenisPemasukan::all()
    //     ];

    //     return view('dashboard.pengeluaran.index', $data);
    // }
    public function index()
{
    $data = pengeluaran::all();
    return view('dashboard.pengeluaran.index', compact('data'));
}

    public function store(PengeluaranCreateRequest $request)
    {
        $data = $request->validated();

        if ($path = $request->file('file')) {
            $path = $path->storePublicly('', 'public');
            $data['file'] = $path;
        }

        $pengeluaran = Pengeluaran::query()->create($data);

        if (!$pengeluaran) {
            return response()->json([
                'message' => 'Failed create pengeluaran'
            ], 403);
        }

        return response()->json([
            'message' => 'Pengeluaran created'
        ], 201);
    }

    public function download(Request $request)
    {
        return Storage::download("public/$request->path");
    }

    public function update(PengeluaranUpdateRequest $request)
    {
        $data = $request->validated();
        $pengeluaran = Pengeluaran::query()->find($request->id);

        if ($path = $request->file('file')) {
            // Delete old file
            if ($pengeluaran->file) {
                Storage::delete("public/$pengeluaran->file");
            }

            // Store new file
            $path = $path->storePublicly('', 'public');
            $data['file'] = $path;
        }

        $pengeluaran->fill($data)->save();

        return [
            'message' => 'Berhasil update surat!'
        ];
    }

    public function delete(int $id)
    {
        $pengeluaran = Pengeluaran::query()->find($id);

        if (!$pengeluaran) {
            throw new HttpResponseException(response()->json([
                'message' => 'Not found'
            ])->setStatusCode(404));
        }

        // Deleting file
        Storage::delete("public/$pengeluaran->file");
        // Deleting surat
        $pengeluaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data pengeluaran'
        ], 200);
    }
}
