<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CutiController extends Controller
{
    public function pernahcuti()
    {
        $karyawan = DB::select('select distinct k.no, k.nomor_induk, k.nama, k.alamat, k.tanggal_lahir, k.tanggal_bergabung
                                from karyawan k inner join cuti c
                                where k.nomor_induk = c.nomor_induk');

        return $karyawan;
    }

    public function sisacuti()
    {
        $daftar_sisa_cuti = DB::select('select k.nomor_induk, k.nama, 
                                                12 - coalesce(
                                                (
                                                    select sum(lama_cuti)
                                                    from cuti c
                                                    where k.nomor_induk = c.nomor_induk
                                                    group by nomor_induk
                                                ), 0) as sisa_cuti
                                        from karyawan k');

        return $daftar_sisa_cuti;
    }
}
