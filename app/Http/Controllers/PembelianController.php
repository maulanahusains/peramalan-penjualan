<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\Stok;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    private function weekOfMonth($date)
    {
        $firstDayOfMonth = $date->copy()->firstOfMonth();
        return $date->diffInWeeks($firstDayOfMonth) + 1;
    }

    public function index()
    {
        $pembelians = Pembelian::all();
        $produks = Produk::all();
        $date = new Carbon();
        $week_of_month = $this->weekOfMonth($date);

        return view('pages.pembelian.index', compact(
            'pembelians',
            'produks',
            'date',
            'week_of_month'
        ));
    }

    public function get_max_stok_produk($kd_produk)
    {
        $stok = Stok::where('kd_produk', $kd_produk)->first();
        return $stok->stok;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kd_produk' => ['required'],
            'jumlah_pembelian' => ['required'],
            'harga_satuan' => ['required'],
            'tanggal_pembelian' => ['required', 'date'],
            'minggu' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        $date = new Carbon($request->tanggal_pembelian);

        if ($request->minggu == 'nextmo_1') {
            $minggu = 1;
            $new_date = $date->copy()->addMonth();
            $bulan = $new_date->format('F');
        } else {
            $bulan = $date->format('F');
        }

        $pembelian = Pembelian::where('tgl_pembelian', date('Y-m-d', strtotime($request->tanggal_pembelian)))
            ->where('minggu', (isset($minggu)) ? $minggu : $request->minggu)
            ->first();

        if ($pembelian) {
            DB::beginTransaction();
            try {
                $stok = Stok::where('kd_produk', $pembelian->kd_produk)
                    ->first();
                $stok->stok = $stok->stok + $request->jumlah_pembelian;
                $stok->save();

                $pembelian->jumlah_pembelian += $request->jumlah_pembelian;
                $pembelian->save();

                DB::commit();
                return redirect()
                    ->route('pembelian.index')
                    ->with('success', 'Sukses Menambah Data!');
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
                return redirect()
                    ->route('pembelian.index')
                    ->with('error', 'Something went wrong!');
            }
        }

        DB::beginTransaction();
        try {
            $pembelian = new Pembelian;
            $pembelian->kd_produk = $request->kd_produk;
            $pembelian->tgl_pembelian = $date->format('Y-m-d');
            $pembelian->jumlah_pembelian = $request->jumlah_pembelian;
            $pembelian->harga_satuan = str_replace(",", "", $request->harga_satuan);
            $pembelian->minggu = (isset($minggu)) ? $minggu : $request->minggu;
            $pembelian->bulan = $bulan;
            $pembelian->created_by = Auth::User()->id;
            $pembelian->save();

            $stok = Stok::where('kd_produk', $pembelian->kd_produk)->first();
            $stok->stok = $stok->stok + $pembelian->jumlah_pembelian;
            $stok->save();

            DB::commit();
            return redirect()
                ->route('pembelian.index')
                ->with('success', 'Sukses Menambah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            return redirect()
                ->route('pembelian.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $pembelian = Pembelian::where('id', $id)->first();
        $produks = Produk::all();
        if (!$pembelian) {
            return redirect()
                ->route('pembelian.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        return view('pages.pembelian.edit', compact('pembelian', 'produks'));
    }

    public function update(Request $request, $id)
    {
        $pembelian = Pembelian::where('id', $id)->first();

        if (!$pembelian) {
            return redirect()
                ->route('pembelian.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        $validator = Validator::make($request->all(), [
            'kd_produk' => ['required'],
            'jumlah_pembelian' => ['required'],
            'harga_satuan' => ['required'],
            'minggu' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        $date = new Carbon($pembelian->tgl_pembelian);

        if ($request->minggu == 'nextmo_1') {
            $minggu = 1;
            $new_date = $date->copy()->addMonth();
            $bulan = $new_date->format('F');
        } else {
            $bulan = $date->format('F');
        }

        DB::beginTransaction();
        try {
            $stok = Stok::where('kd_produk', $request->kd_produk)->first();

            if ($request->jumlah_pembelian != $pembelian->jumlah_pembelian) {
                $stok_semula = $stok->stok - $pembelian->jumlah_pembelian;
                $stok_berubah = $stok_semula + $request->jumlah_pembelian;
            }

            $pembelian->kd_produk = $request->kd_produk;
            $pembelian->tgl_pembelian = $date->format('Y-m-d');
            $pembelian->jumlah_pembelian = $request->jumlah_pembelian;
            $pembelian->harga_satuan = str_replace(",", "", $request->harga_satuan);
            $pembelian->minggu = (isset($minggu)) ? $minggu : $request->minggu;
            $pembelian->bulan = $bulan;
            $pembelian->save();

            $stok->stok = (isset($stok_berubah)) ? $stok_berubah : $pembelian->jumlah_pembelian;
            $stok->save();

            DB::commit();
            return redirect()
                ->route('pembelian.index')
                ->with('success', 'Sukses Mengubah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('pembelian.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function delete($id)
    {
        $pembelian = Pembelian::where('id', $id)->first();

        if (!$pembelian) {
            return redirect()
                ->route('pembelian.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        DB::beginTransaction();
        try {
            $stok = Stok::where('kd_produk', $pembelian->kd_produk)->first();
            $stok->stok = $stok->stok - $pembelian->jumlah_pembelian;
            $stok->save();

            $pembelian->delete();

            DB::commit();
            return redirect()
                ->route('pembelian.index')
                ->with('success', 'Sukses Menghapus Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('pembelian.index')
                ->with('error', 'Something went wrong!');
        }
    }
}
