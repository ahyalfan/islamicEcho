<?php

namespace Database\Seeders;

use App\Models\Ayat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class AyatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i=1; $i <= 114; $i++) { 
            $respons = Http::get("https://raw.githubusercontent.com/kopen1/isline/master/src/data/surah/$i.json");
            $respons2 = Http::get("https://al-quran-8d642.firebaseio.com/surat/$i.json");
            // Mendapatkan body dari respons
            $body = $respons->getBody();
            $body2 = $respons2->getBody();

            // Mengonversi body menjadi format JSON
            $jsonData = json_decode($body, true);
            $jsonData2 = json_decode($body2, true);
            // \var_dump($jsonData['data']);

            $ayats = $jsonData['data'];
            foreach ($ayats as $index => $ayat) {
                // \var_dump($ayat) ;
                // Ayat::create([
                //     'surat_id'=> $jsonData['no_surah'],
                //     "indo"=> $ayat["id"],
                //     "arab"=> $ayat['arab'],
                //     "nomer_ayat"=> $ayat['no'],
                //     "juz"=> $ayat['juz'],
                //     "page"=> $ayat['page'],
                //     'latin' => $jsonData2[$index]['tr'],
                //     ]);
                $data[]=[
                    'surat_id'=> $jsonData['no_surah'],
                    "indo"=> $ayat["id"],
                    "arab"=> $ayat['arab'],
                    "nomer_ayat"=> $ayat['no'],
                    "juz"=> $ayat['juz'],
                    "page"=> $ayat['page'],
                    'latin' => $jsonData2[$index]['tr'],
                ];
            }
        }

        // disini kita bisa menggunakan array_chunk yang mana ini akan secara singkat menambahkan data ke database walaupun dengan data yg sangat banyak
        // contoh memasukan data 
        // for ($i=1; $i <= 1000000; $i++) { 
        //     $data[] = [
        //         'ayat_id'=> Arr::random(1,2,3,4), //arr::random artinya akan mengisikan random sesuai didalam function
        //         'jenis_tafsir' => Arr::random('wajiz',"tahlili"),
        //         'description' => 'testststsafhdahjdak',
        //     ];
        // }
        // dengan ini kita dapat memasukan data ke dalam database dengan singkat
        foreach (\array_chunk($data,500) as $value) {
            Ayat::insert($value);
        }
        // array chunk ini akan membagi setiap array sesuai yg kita inputkan diparameter
        // contohnya diatas dibagi per 1000 data
    }
}
