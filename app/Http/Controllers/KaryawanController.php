<?php

namespace App\Http\Controllers;

use App\Http\Resources\KaryawanResource;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Karyawan::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $karyawan = Karyawan::create([
            'nomor_induk' => $request->nomor_induk,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_bergabung' => $request->tanggal_bergabung,
        ]);

        return new KaryawanResource($karyawan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        return new KaryawanResource($karyawan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $karyawan->update($request->only(['nama', 'alamat', 'tanggal_lahir', 'tanggal_bergabung']));

        return new KaryawanResource($karyawan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return response(null, 204);
    }

    public function topjoin()
    {
        $karyawan = DB::select('select * from karyawan order by tanggal_bergabung asc limit 3');

        return $karyawan;
    }
}
