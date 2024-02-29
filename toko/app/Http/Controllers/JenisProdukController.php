<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\JenisProduk;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DIGUNAKAN UNTUK MENAMPILKAN DATA
        $jenis = JenisProduk::all();
        if (isset($jenis)) {
            $peringatan = [
                'message' => "Data jenis ditemukan",
                'data' => $jenis
            ];
            return response()->json($peringatan,200);
        }  else {
            $peringatan = [
                'message' => "Data jenis tidak ditemukan",
                'data' => $jenis
            ];
            return response()->json($peringatan,404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = [
            'nama' => 'required'
        ];
        $validator = Validator::make($request->all(),$data);
        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal Menambahkan Jenis Produk",
                "data" => $validator->errors()
            ];
            return response()->json($fails,400);
        } else {
            $jenis = new JenisProduk();
            $jenis->nama = $request->input('nama');
            $jenis->save();
            $success = [
                "message" => "Data Jenis Produk Berhasil",
                "data" => $jenis
            ];
            return response()->json($success,200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // DIGUNAKAN UNTUK MENGUPDATE DATA
        $validator = Validator::make($request->all(),[
            'nama' => 'required'
        ]);

        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal Mengupdate Jenis Produk",
                "data" => $validator->errors()
            ];
        }

        $jenis = JenisProduk::find($id);
        if (isset($jenis)) {
            $jenis->update($request->all());
            $success = [
                "message" => "Data Jenis Produk Berhasil Diubah",
                "data" => $jenis
            ];
            return response()->json($success,200);
        } else {
            $fails = [
                "message" => "Gagal Mengupdate Jenis Produk",
                "data" => $validator->errors()
            ];
            return response()->json($fails,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA
        $jenis = JenisProduk::where('id',$id)->first();
        if(isset($jenis)) {
            $jenis->delete();
            $success = [
                "message" => "Data Jenis Produk Berhasil Dihapus",
                "data" => $jenis
            ];
            return response()->json($success,200);
        } else {
            $fails = [
                "message" => "Gagal Menghapus Jenis Produk",
            ];
            return response()->json($fails,404);
        }
    }
}
