<?php

namespace Database\Seeders;

use App\Models\HadistCollection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HadistCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        HadistCollection::create([
            "type" => "hadist category",
            "category_name" => "abu-daud",
            "slug" => "abu-daud",
        ]);
        HadistCollection::create([
            "type" => "hadist category",
            "category_name" => "ahmad",
            "slug" => "ahmad",
        ]);
        HadistCollection::create([
            "type" => "hadist category",
            "category_name" => "bukhari",
            "slug" => "bukhari",
        ]);
        HadistCollection::create([
            "type" => "hadist category",
            "category_name" => "darimi",
            "slug" => "darimi",
        ]);
        HadistCollection::create([
            "type" => "hadist category",
            "category_name" => "ibnu-majah",
            "slug" => "ibnu-majah",
        ]);
        HadistCollection::create([
            "type" => "hadist category",
            "category_name" => "malik",
            "slug" => "malik",
        ]);
        HadistCollection::create([
            "type" => "hadist category",
            "category_name" => "muslim",
            "slug" => "muslim",
        ]);
        HadistCollection::create([
            "type" => "hadist category",
            "category_name" => "nasai",
            "slug" => "nasai",
        ]);
        HadistCollection::create([
            "type" => "hadist category",
            "category_name" => "tirmidzi",
            "slug" => "tirmidzi",
        ]);
    }
}
