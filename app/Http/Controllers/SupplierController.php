<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('pages.master-data.supplier.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => ['required'],
            'nama_perusahaan' => ['required'],
            'alamat' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        DB::beginTransaction();
        try {
            $supplier = new Supplier;
            $supplier->nama_supplier = $request->nama_supplier;
            $supplier->nama_perusahaan = $request->nama_perusahaan;
            $supplier->alamat = $request->alamat;
            $supplier->save();

            DB::commit();
            return redirect()
                ->route('kelola.supplier.index')
                ->with('success', 'Sukses Menambah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('kelola.supplier.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        if (!$supplier) {
            return redirect()
                ->route('kelola.supplier.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        return view('pages.master-data.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::where('id', $id)->first();

        if (!$supplier) {
            return redirect()
                ->route('kelola.supplier.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        $validator = Validator::make($request->all(), [
            'nama_supplier' => ['required'],
            'nama_perusahaan' => ['required'],
            'alamat' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        DB::beginTransaction();
        try {
            $supplier->nama_supplier = $request->nama_supplier;
            $supplier->nama_perusahaan = $request->nama_perusahaan;
            $supplier->alamat = $request->alamat;
            $supplier->save();

            DB::commit();
            return redirect()
                ->route('kelola.supplier.index')
                ->with('success', 'Sukses Mengubah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('kelola.supplier.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function delete($id)
    {
        $supplier = Supplier::where('id', $id)->first();

        if (!$supplier) {
            return redirect()
                ->route('kelola.supplier.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        DB::beginTransaction();
        try {
            $supplier->delete();

            DB::commit();
            return redirect()
                ->route('kelola.supplier.index')
                ->with('success', 'Sukses Menghapus Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('kelola.supplier.index')
                ->with('error', 'Something went wrong!');
        }
    }
}
