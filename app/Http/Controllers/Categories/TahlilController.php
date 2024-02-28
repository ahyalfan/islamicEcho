<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Ayat;
use App\Models\Surat;
use App\Models\Tahlil;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TahlilController extends Controller
{
    public function index(){
        $tahlil = Tahlil::all();
        $surat = Surat::where("indo","Yasin")->first();
        $yasin = Ayat::where("surat_id",$surat->nomer_surah)->get();
        return Inertia::render("User/Categories/Tahlil", [
            "tahlils"=> $tahlil,
            // "yasin"=> $surat
            "yasin"=> $yasin
        ]);
    }
}
