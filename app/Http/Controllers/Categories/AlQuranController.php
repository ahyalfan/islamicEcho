<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Ayat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AlQuranController extends Controller
{
    public function index(){
        $surats = Surat::with("ayat")->get();
        $juz = [] ;
        for($i = 1; $i <= 30; $i++){
            $juz[] = Ayat::with('surat')->where('juz', $i)->selectRaw('surat_id,juz, COUNT(*) AS jumlah_ayat')->groupBy(['surat_id','juz'])->orderBy('surat_id','asc')->get();//
        };
        return Inertia::render("User/Categories/Alquran", [
            "surat"=> $surats,
            "juz"=> $juz,
        ]);
    }

    public function detail($id){
        $surat = Surat::where(["id"=> $id])->with(["ayat","ayat.audio"])->get();
        // $ayat = Ayat::where(["surat_id"=> $surat->id])->get();
        return Inertia::render("User/Detail/Alquran", [
            "surat"=> $surat,
            // "ayats"=> $ayat,
        ]);
    }
    public function detailjuz($id){
        $ayat = Ayat::with('surat')->where('juz',$id)->get();
        return Inertia::render("User/Detail/Alquranjuz", [
            "ayats"=> $ayat,
            'juz'=> $id,
        ]);
    }
}
