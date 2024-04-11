<?php

namespace Tests\Feature;

use App\Models\AudioAyat;
use App\Models\Ayat;
use App\Models\CategoryDoa;
use App\Models\Doa;
use App\Models\Surat;
use App\Models\TafsirAyat;
use App\Models\Tahlil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

use function PHPUnit\Framework\assertJson;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

class alQuranTest extends TestCase
{
    // ini harusnya ditaruh di seeder, karena ini bukan test tapi scrapping data
    public function test_get_surat()
    {
        $respons = Http::get("https://raw.githubusercontent.com/kopen1/isline/master/src/data/listsurah.json");
        $respons2 = Http::get("https://al-quran-8d642.firebaseio.com/data.json");
        // Mendapatkan body dari respons
        $body = $respons->getBody();
        $body2 = $respons2->getBody();

        // Mengonversi body menjadi format JSON
        $jsonData = json_decode($body, true);
        $jsonData2 = json_decode($body2, true);
        // assertNull($jsonData);

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
    public function test_get_ayat()
    {
        for ($i=1; $i <= 114; $i++) { 
            $respons = Http::get("https://raw.githubusercontent.com/kopen1/isline/master/src/data/surah/$i.json");
            $respons2 = Http::get("https://al-quran-8d642.firebaseio.com/surat/$i.json");
            // Mendapatkan body dari respons
            $body = $respons->getBody();
            $body2 = $respons2->getBody();

            // Mengonversi body menjadi format JSON
            $jsonData = json_decode($body, true);
            $jsonData2 = json_decode($body2, true);
            assertNotNull($jsonData);
            // \var_dump($jsonData['data']);

            $ayats = $jsonData['data'];
            foreach ($ayats as $index => $ayat) {
                // \var_dump($ayat) ;
                Ayat::create([
                    'surat_id'=> $jsonData['no_surah'],
                    "indo"=> $ayat["id"],
                    "arab"=> $ayat['arab'],
                    "nomer_ayat"=> $ayat['no'],
                    "juz"=> $ayat['juz'],
                    "page"=> $ayat['page'],
                    'latin' => $jsonData2[$index]['tr'],
                    ]);
            }
        }
    }

    public function test_get_ayat_tafsir()
    {
        for ($i=1; $i <= 114; $i++) { 
            $respons = Http::get("https://raw.githubusercontent.com/kopen1/isline/master/src/data/surah/$i.json");
            // Mendapatkan body dari respons
            $body = $respons->getBody();

            // Mengonversi body menjadi format JSON
            $jsonData = json_decode($body, true);
            assertNotNull($jsonData);
            // \var_dump($jsonData['data']);

            $ayats = $jsonData['data'];
            foreach ($ayats as $index => $ayat) {
                // \var_dump($ayat) ;
                TafsirAyat::create([
                    "ayat_id"=>$ayat['no'],
                    "jenis_tafsir" => "wajiz",
                    "description" => $ayat["tafsir"]['wajiz'],
                ]);
                TafsirAyat::create([
                    "ayat_id"=>$ayat['no'],
                    "jenis_tafsir" => "tahlili",
                    "description" => $ayat["tafsir"]['tahlili'],
                ]);
            }
        }
    }

    public function test_get_ayat_audio(){
        for ($i= 1; $i <= 6236; $i++) {
            // $respons = Http::get('https://cdn.islamic.network/quran/audio/128/ar.muhammadayyoub/6236.mp3'); // ini audionya, dan kita akan mengambil pathnya saja
            AudioAyat::create([
                'ayat_id'=>$i,
                'qori_name'=> 'alafasy',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.alafasy/$i.mp3",
            ]);
        }
        for ($i= 1; $i <= 6236; $i++) {
            AudioAyat::create([
                'ayat_id'=>$i,
                'qori_name'=> 'ahmedajamy',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.ahmedajamy/$i.mp3",
            ]);
        }
        for ($i= 1; $i <= 6236; $i++) {
            AudioAyat::create([
                'ayat_id'=>$i,
                'qori_name'=> 'husarymujawwad',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.husarymujawwad/$i.mp3",
            ]);
        }
        for ($i= 1; $i <= 6236; $i++) {
            AudioAyat::create([
                'ayat_id'=>$i,
                'qori_name'=> 'minshawi',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.minshawi/$i.mp3",
            ]);
        }
        for ($i= 1; $i <= 6236; $i++) {
            AudioAyat::create([
                'ayat_id'=>$i,
                'qori_name'=> 'muhammadayyoub',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.muhammadayyoub/$i.mp3",
            ]);
        }
        for ($i= 1; $i <= 6236; $i++) {
            AudioAyat::create([
                'ayat_id'=>$i,
                'qori_name'=> 'muhammadjibreel',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.muhammadjibreel/$i.mp3",
            ]);
        }
        assertTrue(true);
    }

    public function test_get_doa(){
        $response = Http::get("https://raw.githubusercontent.com/fitrahive/dua-dhikr/main/data/dua-dhikr/daily-dua/id.json");
        $response->getBody();
        $response = json_decode($response, true);

        $response2 = Http::get("https://raw.githubusercontent.com/fitrahive/dua-dhikr/main/data/dua-dhikr/dhikr-after-salah/id.json");
        $response2->getBody();
        $response2 = json_decode($response2, true);

        $response3 = Http::get("https://raw.githubusercontent.com/fitrahive/dua-dhikr/main/data/dua-dhikr/evening-dhikr/id.json");
        $response3->getBody();
        $response3 = json_decode($response3, true);

        $response4 = Http::get("https://raw.githubusercontent.com/fitrahive/dua-dhikr/main/data/dua-dhikr/morning-dhikr/id.json");
        $response4->getBody();
        $response4 = json_decode($response4, true);

        $response5 = Http::get("https://raw.githubusercontent.com/fitrahive/dua-dhikr/main/data/dua-dhikr/selected-dua/id.json");
        $response5->getBody();
        $response5 = json_decode($response5, true);

        foreach ($response as $key => $value) {
            Doa::create([
                'category_id' => 1,
                'title' => $value['title'],
                "indo" => $value["translation"],
                "arab" => $value["arabic"],
                "latin"=> $value["latin"],
                "fawaid" => $value["fawaid"],
                "src" => $value["source"],
            ]);
        }
        foreach ($response2 as $key => $value) {
            Doa::create([
                'category_id' => 2,
                'title' => $value['title'],
                "indo" => $value["translation"],
                "arab" => $value["arabic"],
                "latin"=> $value["latin"],
                "notes"=> $value["notes"],
                "fawaid" => $value["fawaid"],
                "src" => $value["source"],
            ]);
        }
        foreach ($response3 as $key => $value) {
            Doa::create([
                'category_id' => 3,
                'title' => $value['title'],
                "indo" => $value["translation"],
                "arab" => $value["arabic"],
                "latin"=> $value["latin"],
                "notes"=> $value["notes"],
                "fawaid" => $value["fawaid"],
                "src" => $value["source"],
            ]);
        }
        foreach ($response4 as $key => $value) {
            Doa::create([
                'category_id' => 4,
                'title' => $value['title'],
                "indo" => $value["translation"],
                "arab" => $value["arabic"],
                "latin"=> $value["latin"],
                "notes"=> $value["notes"],
                "fawaid" => $value["fawaid"],
                "src" => $value["source"],
            ]);
        }
        foreach ($response5 as $key => $value) {
            Doa::create([
                'category_id' => 5,
                'title' => $value['title'],
                "indo" => $value["translation"],
                "arab" => $value["arabic"],
                "latin"=> $value["latin"],
                "fawaid" => $value["fawaid"],
                "notes"=> $value["notes"],
                "src" => $value["source"],
            ]);
        }
        assertTrue(\true);
    }

    public function test_get_tahlil(){
        $response = Http::get("https://raw.githubusercontent.com/kopen1/isline/master/src/data/tahlil.json");
        $response->getBody();
        $response = json_decode($response, true);
        \var_dump($response);
        assertTrue(true);
        foreach($response as $value){
            Tahlil::create([
                "no"=> $value["no"],
                "judul"=> $value["judul"],
                "indo"=> $value["id"],
                "arab"=> $value["arab"],
            ]);
        }
    }

}
