<?php

function cek($nilai)
{
    if ($nilai >= 85) {
        return "Kamu Sangat Kompeten";
    } else if ($nilai >= 75) {
        return "Kamu Cukup Kompeten";
    } else if ($nilai >= 60) {
        return "Kamu Kurang Kompeten";
    } else {
        return "Kamu Belum Kompeten";
    }
}

$siswa = [];

echo "\n=== PROGRAM CEK NILAI ===\n";
$jumlah = (int) readline("Berapa Jumlah Siswa: ");

for ($i = 0; $i < $jumlah; $i++) {
    $nama = readline("Nama :  ");
    $nilai = (int) readline("Nilai:  ");
    echo "\n";

    $siswa[] = [
        "nama" => $nama,
        "nilai" => $nilai,
    ];
}

try {
    if ($nilai < 0 || $nilai > 100) {
        throw new Exception("Nilai Harus Berada Di Antara 0 Dan 100");
    }


    echo "==== HASIL ====\n";
    foreach ($siswa as $data) {

        $kategori = cek($data["nilai"]);

        echo "Nama     : " . $data["nama"] . "\n";
        echo "Nilai    : " . $data["nilai"] . "\n";
        echo "Kategori : " . $kategori . "\n\n";
    }
} catch (Exception $e) {
    echo "error :" . $e->getMessage();
}
