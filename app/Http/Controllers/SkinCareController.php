<?php

namespace App\Http\Controllers;

use App\Models\SkinCare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isNull;

class SkinCareController extends Controller
{
    /**
     * Menampilkan Halaman Utama
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skin_care = SkinCare::all();

        return view('skin_care', ['skin_care' => $skin_care]);
    }

    /**
     * Simpan data Produk kedalam database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tambahSkinCare(Request $request)
    {
        // validasi data yang dikirim oleh user
        $request->validate([
            "nama" => "required|string",
            "brand" => "required|string",
            "deskripsi" => "required|string|max:254",
            "gambar" => "required|image|mimes:jpeg,png,jpg,gif,svg",
        ]);

        // menamai dan memindahkan data gambar ke folder uploads
        $nama_gambar = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('uploads'), $nama_gambar);

        SkinCare::create([
            'nama' => $request->nama,
            'brand' => $request->brand,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'uploads/'.$nama_gambar,
        ]);

        // kembali ke halaman utama dengan pesan sukses
        return back()->with('success','Produk berhasil didaftarkan');
    }

    public function updateSkinCare(Request $request, $skin_care_id)
    {
        // validasi data yang dikirim oleh user
        $request->validate([
            "nama" => "required|string",
            "brand" => "required|string",
            "deskripsi" => "required|string|max:254",
            "gambar" => "image|mimes:jpeg,png,jpg,gif,svg",
        ]);

        $skin_care_db = SkinCare::find($skin_care_id);
        $skin_care_db->nama = $request->nama;
        $skin_care_db->brand = $request->brand;
        $skin_care_db->deskripsi = $request->deskripsi;

        // jika user mengubah gambar maka hapus gambar lama dan ganti yang baru
        if ($request->hasFile('gambar'))
        {
            // menamai dan memindahkan data gambar baru ke folder uploads
            $nama_gambar = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $nama_gambar);
            // get path gambar lama dari database dan hapus file gambar lama
            File::delete(public_path().'/'.$skin_care_db->gambar);

            $skin_care_db->gambar = 'uploads/'.$nama_gambar;
        }

        // update data Produk
        $skin_care_db->save();

        // kembali ke halaman utama dengan pesan sukses
        return back()->with('success','Produk berhasil diupdate');

    }

    public function hapusSkinCare($skin_care_id)
    {
        $skin_care_db = SkinCare::find($skin_care_id);

        // hapus gambar
        File::delete(public_path().'/'.$skin_care_db->gambar);

        $skin_care_db->delete();

        // kembali ke halaman utama dengan pesan sukses
        return back()->with('success','Makanan Khas berhasil dihapus');
    }
}
