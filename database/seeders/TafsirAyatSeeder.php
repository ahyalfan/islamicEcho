<?php

namespace Database\Seeders;

use App\Models\Ayat;
use App\Models\TafsirAyat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TafsirAyatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $j = 1;
        for ($i=1; $i <= 114; $i++) { 
            $respons = Http::get("https://raw.githubusercontent.com/kopen1/isline/master/src/data/surah/$i.json");
            // Mendapatkan body dari respons
            $body = $respons->getBody();

            // Mengonversi body menjadi format JSON
            $jsonData = json_decode($body, true);
            // \var_dump($jsonData['data']);

            $ayats = $jsonData['data'];
            foreach ($ayats as $index => $ayat) {
                // \var_dump($ayat) ;
                // TafsirAyat::create([
                //     "ayat_id"=>$j,
                //     "surah"=>$jsonData["no_surah"],
                //     "jenis_tafsir" => "wajiz",
                //     "description" => $ayat["tafsir"]['wajiz'],
                // ]);
                // TafsirAyat::create([
                //     "ayat_id"=>$j,
                //     "surah"=>$jsonData["no_surah"],
                //     "jenis_tafsir" => "tahlili",
                //     "description" => $ayat["tafsir"]['tahlili'],
                // ]);
                $data[]=[
                    "ayat_id"=>$j,
                    "surah"=>$jsonData["no_surah"],
                    "jenis_tafsir" => "wajiz",
                    "description" => $ayat["tafsir"]['wajiz'],
                ];
                $data[]=[
                    "ayat_id"=>$j,
                    "surah"=>$jsonData["no_surah"],
                    "jenis_tafsir" => "tahlili",
                    "description" => $ayat["tafsir"]['tahlili'],
                ];
                $j++;
            }
            // $j++;
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
        foreach (\array_chunk($data,1000) as $value) {
            TafsirAyat::insert($value);
        }
        // array chunk ini akan membagi setiap array sesuai yg kita inputkan diparameter
        // contohnya diatas dibagi per 1000 data

        // delete
        // DB::delete('delete from tafsir_ayats');
    }
}
