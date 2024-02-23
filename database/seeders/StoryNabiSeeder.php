<?php

namespace Database\Seeders;

use App\Models\StoryNabi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class StoryNabiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get("https://raw.githubusercontent.com/AzharRivaldi/Kisah-25-Nabi/master/Kisah25Nabi/app/src/main/assets/kisahnabi.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            StoryNabi::create([
                "name"=> $value["name"],
                "usia"=> $value["usia"],
                "thn_kelahiran"=> $value["thn_kelahiran"],
                "tempat"=> $value["tmp"],
                "description"=> $value["description"],
                "url_img"=> $value["image_url"],
            ]);
        }
    }
}
