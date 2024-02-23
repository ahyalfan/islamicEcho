<?php

namespace Database\Seeders;

use App\Models\Tahlil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TahlilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get("https://raw.githubusercontent.com/kopen1/isline/master/src/data/tahlil.json");
        $response->getBody();
        $response = json_decode($response, true);
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
