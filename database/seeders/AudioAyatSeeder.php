<?php

namespace Database\Seeders;

use App\Models\AudioAyat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class AudioAyatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i= 1; $i <= 6236; $i++) {
            // $respons = Http::get('https://cdn.islamic.network/quran/audio/128/ar.muhammadayyoub/6236.mp3'); // ini audionya, dan kita akan mengambil pathnya saja
            // AudioAyat::create([
            //     'ayat_id'=>$i,
            //     'qori_name'=> 'alafasy',
            //     'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.alafasy/$i.mp3",
            // ]);
            $data[]=[
                'ayat_id'=>$i,
                'qori_name'=> 'alafasy',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.alafasy/$i.mp3",
            ];
        }
        for ($i= 1; $i <= 6236; $i++) {
            // AudioAyat::create([
            //     'ayat_id'=>$i,
            //     'qori_name'=> 'ahmedajamy',
            //     'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.ahmedajamy/$i.mp3",
            // ]);
            $data[]=[
                'ayat_id'=>$i,
                'qori_name'=> 'ahmedajamy',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.ahmedajamy/$i.mp3",
            ];
        }
        for ($i= 1; $i <= 6236; $i++) {
            // AudioAyat::create([
            //     'ayat_id'=>$i,
            //     'qori_name'=> 'husarymujawwad',
            //     'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.husarymujawwad/$i.mp3",
            // ]);
            $data[]=[
                'ayat_id'=>$i,
                'qori_name'=> 'husarymujawwad',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.husarymujawwad/$i.mp3",
            ];
        }
        for ($i= 1; $i <= 6236; $i++) {
            // AudioAyat::create([
            //     'ayat_id'=>$i,
            //     'qori_name'=> 'minshawi',
            //     'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.minshawi/$i.mp3",
            // ]);

            $data[]=[
                'ayat_id'=>$i,
                'qori_name'=> 'minshawi',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.minshawi/$i.mp3",
            ];
        }
        for ($i= 1; $i <= 6236; $i++) {
            // AudioAyat::create([
            //     'ayat_id'=>$i,
            //     'qori_name'=> 'muhammadayyoub',
            //     'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.muhammadayyoub/$i.mp3",
            // ]);
            $data[]=[
                'ayat_id'=>$i,
                'qori_name'=> 'muhammadayyoub',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.muhammadayyoub/$i.mp3",
            ];
        }
        for ($i= 1; $i <= 6236; $i++) {
            // AudioAyat::create([
            //     'ayat_id'=>$i,
            //     'qori_name'=> 'muhammadjibreel',
            //     'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.muhammadjibreel/$i.mp3",
            // ]);
            $data[]=[
                'ayat_id'=>$i,
                'qori_name'=> 'muhammadjibreel',
                'path_audio'=> "https://cdn.islamic.network/quran/audio/128/ar.muhammadjibreel/$i.mp3",
            ];
        }

        foreach (\array_chunk($data,5000) as $value) {
            AudioAyat::insert($value);
        }
    }
}
