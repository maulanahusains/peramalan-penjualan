<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('pages.master-data.produk.index', compact('produks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => ['required'],
            'deskripsi' => ['required'],
            'photo' => ['mimes:png,jpg,jpeg'],
            'stok' => ['required', 'numeric'],
            'harga' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = Str::uuid() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('images/upload'), $photo_name);
            $photo_path = 'images/upload/' . $photo_name;
        }

        DB::beginTransaction();
        try {
            // todo: nambah bulan & minggu ketika create
            $produk = new Produk;
            $produk->nama_produk = $request->nama_produk;
            $produk->deskripsi = $request->deskripsi;
            $produk->stok = $request->stok;
            $produk->photo = (isset($photo_path)) ? $photo_path : '';
            $produk->harga = str_replace(",", "", $request->harga);
            $produk->save();

            DB::commit();
            return redirect()
                ->route('kelola.produk.index')
                ->with('success', 'Sukses Menambah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('kelola.produk.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $produk = Produk::where('id', $id)->first();
        if (!$produk) {
            return redirect()
                ->route('kelola.produk.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        return view('pages.master-data.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::where('id', $id)->first();

        if (!$produk) {
            return redirect()
                ->route('kelola.produk.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        $validator = Validator::make($request->all(), [
            'nama_produk' => ['required'],
            'deskripsi' => ['required'],
            'stok' => ['required', 'numeric'],
            'harga' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        if ($request->hasFile('photo')) {
            if ($produk->photo && Storage::exists($produk->photo)) {
                Storage::delete($produk->photo);
            }

            $photo = $request->file('photo');
            $photo_name = Str::uuid() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('images/upload'), $photo_name);
            $photo_path = 'images/upload/' . $photo_name;
        }

        DB::beginTransaction();
        try {
            $produk->nama_produk = $request->nama_produk;
            $produk->deskripsi = $request->deskripsi;
            $produk->stok = $request->stok;
            $produk->photo = (isset($photo_path)) ? $photo_path : $produk->photo;
            $produk->harga = str_replace(",", "", $request->harga);
            $produk->save();

            DB::commit();
            return redirect()
                ->route('kelola.produk.index')
                ->with('success', 'Sukses Mengubah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            return redirect()
                ->route('kelola.produk.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function delete($id)
    {
        $produk = Produk::where('id', $id)->first();

        if (!$produk) {
            return redirect()
                ->route('kelola.produk.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        DB::beginTransaction();
        try {
            $produk->delete();

            DB::commit();
            return redirect()
                ->route('kelola.produk.index')
                ->with('success', 'Sukses Menghapus Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('kelola.produk.index')
                ->with('error', 'Something went wrong!');
        }
    }
}
