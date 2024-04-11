<?php

namespace Database\Seeders;

use App\Models\CategoryDoa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryDoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_doa = new CategoryDoa();
        $category_doa->type = 'category_doa';
        $category_doa->category_name = 'doa_harian';
        $category_doa->slug = 'doa-harian';
        $category_doa->save();
        $category_doa = new CategoryDoa();
        $category_doa->type = 'category_doa';
        $category_doa->category_name = 'doa_setelah_sholat';
        $category_doa->slug = 'doa-setelah-sholat';
        $category_doa->save();
        $category_doa = new CategoryDoa();
        $category_doa->type = 'category_doa';
        $category_doa->category_name = 'dzikir_pagi';
        $category_doa->slug = 'dzikir-pagi';
        $category_doa->save();
        $category_doa = new CategoryDoa();
        $category_doa->type = 'category_doa';
        $category_doa->category_name = 'dzikir_siang';
        $category_doa->slug = 'dzikir-siang';
        $category_doa->save();
        $category_doa = new CategoryDoa();
        $category_doa->type = 'category_doa';
        $category_doa->category_name = 'doa_pilihan';
        $category_doa->slug = 'doa-pilihan';
        $category_doa->save();
    }
}
