<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

//panggil model BukuModel
use App\Models\BukuModel;

class BukuController extends Controller
{
    //method untuk tampil data buku
    public function bukutampil()
    {
        // $databuku = BukuModel::orderby('kode_buku', 'ASC')
        // ->paginate(5);

        // return view('halaman/view_buku',['buku'=>$databuku]);

        if (Auth::user()->role === 'admin') {
            // Admin melihat semua data buku
            $databuku = BukuModel::orderby('kode_buku', 'ASC')->paginate(5);
        } else {
            // User hanya melihat data buku miliknya
            $databuku = BukuModel::where('user_id', Auth::id())
                ->orderby('kode_buku', 'ASC')
                ->paginate(5);
        }

        return view('halaman/view_buku', ['buku' => $databuku]);
    }

    //method untuk tambah data buku
    public function bukutambah(Request $request)
{
    // Validasi data input
    $this->validate($request, [
        'kode_buku' => 'required',
        'judul' => 'required',
        'pengarang' => 'required',
        'kategori' => 'required',
    ]);

    // Tambah data buku baru
    BukuModel::create([
        'kode_buku' => $request->kode_buku,
        'judul' => $request->judul,
        'pengarang' => $request->pengarang,
        'kategori' => $request->kategori,
        // 'user_id' => Auth::id()
        'user_id' => Auth::user()->id
    ]);

    // Redirect kembali ke halaman buku dengan pesan sukses
    return redirect('/' . Auth::user()->role .'/buku')->with('success', 'Data buku berhasil ditambahkan!');
    // return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui.');
}


     //method untuk hapus data buku
     public function bukuhapus($id_buku)
     {
         $databuku=BukuModel::find($id_buku);
         $databuku->delete();

         return redirect()->back();

     }

     //method untuk edit data buku
    // public function bukuedit($id_buku, Request $request)
    // {
    //     $this->validate($request, [
    //         'id_buku' => 'required',
    //         'kode_buku' => 'required',
    //         'judul' => 'required',
    //         'pengarang' => 'required',
    //         'kategori' => 'required'
    //     ]);

    //     $id_buku = BukuModel::find($id_buku);
    //     $id_buku->kode_buku   = $request->kode_buku;
    //     $id_buku->judul      = $request->judul;
    //     $id_buku->pengarang  = $request->pengarang;
    //     $id_buku->kategori   = $request->kategori;

    //     $id_buku->save();

    //     return redirect()->back();
    // }
    public function bukuedit($id_buku, Request $request)
    {
    // Validasi input
    $this->validate($request, [
        'kode_buku' => 'required',
        'judul' => 'required',
        'pengarang' => 'required',
        'kategori' => 'required',
    ]);

    // Cari data buku berdasarkan ID
    $buku = BukuModel::find($id_buku);

    // Periksa apakah data ditemukan
    if (!$buku) {
        return redirect()->back()->with('error', 'Data buku tidak ditemukan.');
    }

    // Update data buku
    $buku->kode_buku = $request->kode_buku;
    $buku->judul = $request->judul;
    $buku->pengarang = $request->pengarang;
    $buku->kategori = $request->kategori;
    $buku->save();

    // Redirect dengan pesan sukses
    // return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui.');
    return redirect('/' . Auth::user()->role .'/buku')->with('success', 'Data buku berhasil diperbarui.');
    }

}
