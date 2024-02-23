<?php

namespace Database\Seeders;

use App\Models\Hadist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class HadistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // abu-daud
        $response = Http::get("https://raw.githubusercontent.com/gadingnst/hadith-api/master/books/abu-daud.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            Hadist::create([
                "hadist_collection_id"=> 1,
                "nomer"=> $value["number"],
                "arab"=> $value["arab"],
                "indo"=> $value["id"],
            ]);
        }

        // ahmad
        $response = Http::get("https://raw.githubusercontent.com/gadingnst/hadith-api/master/books/ahmad.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            Hadist::create([
                "hadist_collection_id"=> 2,
                "nomer"=> $value["number"],
                "arab"=> $value["arab"],
                "indo"=> $value["id"],
            ]);
        }

        // bukhari
        $response = Http::get("https://raw.githubusercontent.com/gadingnst/hadith-api/master/books/bukhari.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            Hadist::create([
                "hadist_collection_id"=> 3,
                "nomer"=> $value["number"],
                "arab"=> $value["arab"],
                "indo"=> $value["id"],
            ]);
        }

        // darimi
        $response = Http::get("https://raw.githubusercontent.com/gadingnst/hadith-api/master/books/darimi.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            Hadist::create([
                "hadist_collection_id"=> 4,
                "nomer"=> $value["number"],
                "arab"=> $value["arab"],
                "indo"=> $value["id"],
            ]);
        }

        // ibnu-majah
        $response = Http::get("https://raw.githubusercontent.com/gadingnst/hadith-api/master/books/ibnu-majah.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            Hadist::create([
                "hadist_collection_id"=> 5,
                "nomer"=> $value["number"],
                "arab"=> $value["arab"],
                "indo"=> $value["id"],
            ]);
        }

        // malik
        $response = Http::get("https://raw.githubusercontent.com/gadingnst/hadith-api/master/books/malik.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            Hadist::create([
                "hadist_collection_id"=> 6,
                "nomer"=> $value["number"],
                "arab"=> $value["arab"],
                "indo"=> $value["id"],
            ]);
        }        

        // muslim
        $response = Http::get("https://raw.githubusercontent.com/gadingnst/hadith-api/master/books/muslim.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            Hadist::create([
                "hadist_collection_id"=> 7,
                "nomer"=> $value["number"],
                "arab"=> $value["arab"],
                "indo"=> $value["id"],
            ]);
        } 

        // nasai
        $response = Http::get("https://raw.githubusercontent.com/gadingnst/hadith-api/master/books/nasai.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            Hadist::create([
                "hadist_collection_id"=> 8,
                "nomer"=> $value["number"],
                "arab"=> $value["arab"],
                "indo"=> $value["id"],
            ]);
        }      

        // tirmidzi
        $response = Http::get("https://raw.githubusercontent.com/gadingnst/hadith-api/master/books/tirmidzi.json");
        $response->getBody();
        $response = json_decode($response, true);
        foreach($response as $value){
            Hadist::create([
                "hadist_collection_id"=> 9,
                "nomer"=> $value["number"],
                "arab"=> $value["arab"],
                "indo"=> $value["id"],
            ]);
        }      
    }
}
