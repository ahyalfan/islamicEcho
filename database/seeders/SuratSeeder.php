<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $respons = Http::get("https://raw.githubusercontent.com/kopen1/isline/master/src/data/listsurah.json");
        $respons2 = Http::get("https://al-quran-8d642.firebaseio.com/data.json");
        // Mendapatkan body dari respons
        $body = $respons->getBody();
        $body2 = $respons2->getBody();

        // Mengonversi body menjadi format JSON
        $jsonData = json_decode($body, true);
        $jsonData2 = json_decode($body2, true);

        foreach ($jsonData as $index => $surat) {
            // \var_dump($surat) ;
            Surat::create([
                "indo"=> $surat["id"],
                "arab"=> $surat['ar'],
                "jum_ayat"=> $surat['jum_ayat'],
                "nomer_surah"=> $surat['no_surah'],
                "arti"=> $surat['arti'],
                "golongan"=> $surat['golongan'],
                'description' => $jsonData2[$index]['keterangan'],
                'audio_full' => $jsonData2[$index]['audio'],
                ]);
        }
    }
}
