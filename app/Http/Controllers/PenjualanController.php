<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Stok;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PenjualanController extends Controller
{
    private function weekOfMonth($date)
    {
        $firstDayOfMonth = $date->copy()->firstOfMonth();
        return $date->diffInWeeks($firstDayOfMonth) + 1;
    }

    public function index()
    {
        $penjualans = Penjualan::all();
        $produks = Produk::all();
        $date = new Carbon();
        $week_of_month = $this->weekOfMonth($date);

        return view('pages.penjualan.index', compact(
            'penjualans',
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
            'jumlah_penjualan' => ['required', function ($attribute, $value, $fail) use ($request) {
                $maxStok = $this->get_max_stok_produk($request->kd_produk);

                if ($value > $maxStok) {
                    $fail('Jumlah penjualan melebihi stok yang tersedia.');
                }
            }],
            'tanggal_penjualan' => ['required', 'date'],
            'minggu' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        $date = new Carbon($request->tanggal_penjualan);

        if ($request->minggu == 'nextmo_1') {
            $minggu = 1;
            $new_date = $date->copy()->addMonth();
            $bulan = $new_date->format('F');
        } else {
            $bulan = $date->format('F');
        }

        $penjualan = Penjualan::where('tgl_penjualan', date('Y-m-d', strtotime($request->tanggal_penjualan)))
            ->where('minggu', (isset($minggu)) ? $minggu : $request->minggu)
            ->first();

        if ($penjualan) {
            DB::beginTransaction();
            try {
                $stok = Stok::where('kd_produk', $penjualan->kd_produk)
                    ->first();
                $stok->stok = $stok->stok - $request->jumlah_penjualan;
                $stok->save();

                $penjualan->jumlah_penjualan += $request->jumlah_penjualan;
                $penjualan->save();

                DB::commit();
                return redirect()
                    ->route('penjualan.index')
                    ->with('success', 'Sukses Menambah Data!');
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
                return redirect()
                    ->route('penjualan.index')
                    ->with('error', 'Something went wrong!');
            }
        }

        DB::beginTransaction();
        try {
            $penjualan = new Penjualan;
            $penjualan->kd_produk = $request->kd_produk;
            $penjualan->tgl_penjualan = $date->format('Y-m-d');
            $penjualan->jumlah_penjualan = $request->jumlah_penjualan;
            $penjualan->minggu = (isset($minggu)) ? $minggu : $request->minggu;
            $penjualan->bulan = $bulan;
            $penjualan->created_by = Auth::User()->id;
            $penjualan->save();

            $stok = Stok::where('kd_produk', $penjualan->kd_produk)->first();
            $stok->stok = $stok->stok - $penjualan->jumlah_penjualan;
            $stok->save();

            DB::commit();
            return redirect()
                ->route('penjualan.index')
                ->with('success', 'Sukses Menambah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $penjualan = Penjualan::where('id', $id)->first();
        $produks = Produk::all();
        if (!$penjualan) {
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        return view('pages.penjualan.edit', compact('penjualan', 'produks'));
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::where('id', $id)->first();

        if (!$penjualan) {
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        $validator = Validator::make($request->all(), [
            'kd_produk' => ['required'],
            'jumlah_penjualan' => ['required'],
            'minggu' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        $date = new Carbon($penjualan->tgl_penjualan);

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

            if ($request->jumlah_penjualan != $penjualan->jumlah_penjualan) {
                $stok_semula = $stok->stok + $penjualan->jumlah_penjualan;
                $stok_berubah = $stok_semula - $request->jumlah_penjualan;
            }

            $penjualan->kd_produk = $request->kd_produk;
            $penjualan->tgl_penjualan = $date->format('Y-m-d');
            $penjualan->jumlah_penjualan = $request->jumlah_penjualan;
            $penjualan->minggu = (isset($minggu)) ? $minggu : $request->minggu;
            $penjualan->bulan = $bulan;
            $penjualan->save();

            $stok->stok = (isset($stok_berubah)) ? $stok_berubah : $penjualan->jumlah_penjualan;
            $stok->save();

            DB::commit();
            return redirect()
                ->route('penjualan.index')
                ->with('success', 'Sukses Mengubah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function delete($id)
    {
        $penjualan = Penjualan::where('id', $id)->first();

        if (!$penjualan) {
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        DB::beginTransaction();
        try {
            $stok = Stok::where('kd_produk', $penjualan->kd_produk)->first();
            $stok->stok = $stok->stok + $penjualan->jumlah_penjualan;
            $stok->save();

            $penjualan->delete();

            DB::commit();
            return redirect()
                ->route('penjualan.index')
                ->with('success', 'Sukses Menghapus Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Something went wrong!');
        }
    }
}
