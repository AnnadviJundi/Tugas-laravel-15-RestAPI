<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DIGUNAKAN UNTUK MENAMPILKAN DATA
        $produk = Produk::all();
        if (isset($produk)) {
            $hasil = [
                'message' => "Data produk ditemukan",
                'data' => $produk
            ];
            return response()->json($produk,200);
        }  else {
            $peringatan = [
                'message' => "Data produk tidak ditemukan",
                'data' => $produk
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
    $data = [
        'nama' => 'required',
        'stok' => 'required',
        'harga' => 'required',
        'idjenis' => 'required',
    ];

    $validator = Validator::make($request->all(), $data);

    if ($validator->fails()) {
        $fails = [
            "message" => "Gagal Menambahkan Data Produk",
            "data" => $validator->errors()
        ];
        return response()->json($fails, 400);
    } else {
        $produk = new Produk();
        $produk->nama = $request->input('nama');
        $produk->stok = $request->input('stok');
        $produk->harga = $request->input('harga');
        $produk->idjenis = $request->input('idjenis');
        $produk->save();

        $success = [
            "message" => "Data Produk Berhasil",
            "data" => $produk
        ];
        return response()->json($success, 200);
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
        //DIGUNAKAN UNTUK UPDATE DATA PRODUK
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'idjenis' => 'required',
        ]);

        if($validator->fails()) {
            $fails = [
                "message" => "Gagal Mengupdate Data Produk",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 400);
        }

        $produk = Produk::find($id);
        if (isset($produk)) {
            $produk->update($request->all());
            $success = [
                "message" => "Data Produk Berhasil",
                "data" => $produk
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                "message" => "Gagal Mengupdate Data Produk",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA PRODUK
        $produk = Produk::where('id', $id)->first();
        if(isset($produk)) {
            $produk->delete();
            $success = [
                "message" => "Data Produk Berhasil Dihapus",
                "data" => $produk
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                "message" => "Gagal Menghapus Data Produk",
            ];
            return response()->json($fails, 404);
        }
    }
}
