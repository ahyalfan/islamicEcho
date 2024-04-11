<?php

namespace Database\Seeders;

use App\Models\Doa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
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
    }
}
