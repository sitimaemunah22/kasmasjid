<?php

namespace App\Http\Controllers;
use App\Http\Requests\PemasukanCreateRequest;
use App\Http\Requests\PemasukanUpdateRequest;
use App\Models\pemasukan;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PemasukanController extends Controller
{
    // public function index(): View
    // {
    //     $data = [
    //         'pemasukan_with_relationships' => Pemasukan::with('jenis', 'user')->orderByDesc('tanggal_pemasukan')->get(),
    //         'all_pemasukan' => Pemasukan::all()
    //     ];
    
    //     return view('dashboard.pemasukan.index', $data);
    // }
    public function index()
    {
        $data = pemasukan::all();
        return view('dashboard.pemasukan.index', compact('data'));
    }
    public function tambah()
    {
        $data = pemasukan::all();
        // dd($data);
        return view('dashboard.pemasukan.tambah');
    }

    
    public function simpan(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
                // 'id' => 'required',
                'kode_pemasukan' => 'required|integer',
                'id_jenis_pemasukan' => 'required|integer',
                'id_donatur' => 'required|integer',
                'jumlah_pemsukan' => 'required|integer',
                'tanggal_pemasukan' => 'required',
                // 'upload' => 'text',
                ]);

        // dd($data);       
            
        $datainsert = Pemasukan::query()->create($data);

        // dd($datainsert);
            
        if($datainsert):
        return redirect('/dashboard/pemasukan');        
        else:
            $d = 'data anda gagal dimasukkan';
            var_dump($d);
        endif;
    }
}
    

//     public function download(Request $request)
//     {
//         return Storage::download("public/$request->path");
//     }

//     public function update(PemasukanUpdateRequest $request)
//     {
//         $data = $request->validated();
//         $pemasukan = Pemasukan::query()->find($request->id);

//         if ($path = $request->file('file')) {
//             // Delete old file
//             if ($pemasukan->file) {
//                 Storage::delete("public/$pemasukan->file");
//             }

//             // Store new file
//             $path = $path->storePublicly('', 'public');
//             $data['file'] = $path;
//         }

//         $pemasukan->fill($data)->save();

//         return [
//             'message' => 'Berhasil update surat!'
//         ];
//     }

//     public function delete(int $id)
//     {
//         $pemasukan = Pemasukan::query()->find($id);

//         if (!$pemasukan) {
//             throw new HttpResponseException(response()->json([
//                 'message' => 'Not found'
//             ])->setStatusCode(404));
//         }

//         // Deleting file
//         Storage::delete("public/$pemasukan->file");
//         // Deleting surat
//         $pemasukan->delete();

//         return response()->json([
//             'success' => true,
//             'message' => 'Berhasil menghapus data pemasukan'
//         ], 200);
//     }
// }