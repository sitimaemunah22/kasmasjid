<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemasukanCreateRequest;
use App\Http\Requests\PemasukanUpdateRequest;
use App\Models\JenisPemasukan;
use App\Models\pemasukan;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PemasukanController extends Controller
{
    public function index(): View
    {
        $data = [
            'pemasukan' => Pemasukan::with('jenis', 'user')->orderByDesc('tanggal_pemasukan')->get(),
            'jenis_pemasukan' => JenisPemasukan::all()
        ];

        return view('dashboard.pemasukan.index', $data);
    }

    public function store(PemasukanCreateRequest $request)
    {
        $data = $request->validated();

        if ($path = $request->file('file')) {
            $path = $path->storePublicly('', 'public');
            $data['file'] = $path;
        }

        $pemasukan = Pemasukan::query()->create($data);

        if (!$pemasukan) {
            return response()->json([
                'message' => 'Failed create surat'
            ], 403);
        }

        return response()->json([
            'message' => 'Pemasukan created'
        ], 201);
    }

    public function download(Request $request)
    {
        return Storage::download("public/$request->path");
    }

    public function update(PemasukanUpdateRequest $request)
    {
        $data = $request->validated();
        $pemasukan = Pemasukan::query()->find($request->id);

        if ($path = $request->file('file')) {
            // Delete old file
            if ($pemasukan->file) {
                Storage::delete("public/$pemasukan->file");
            }

            // Store new file
            $path = $path->storePublicly('', 'public');
            $data['file'] = $path;
        }

        $pemasukan->fill($data)->save();

        return [
            'message' => 'Berhasil update surat!'
        ];
    }

    public function delete(int $id)
    {
        $pemasukan = Pemasukan::query()->find($id);

        if (!$pemasukan) {
            throw new HttpResponseException(response()->json([
                'message' => 'Not found'
            ])->setStatusCode(404));
        }

        // Deleting file
        Storage::delete("public/$pemasukan->file");
        // Deleting surat
        $pemasukan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data pemasukan'
        ], 200);
    }
}
