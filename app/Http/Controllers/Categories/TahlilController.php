<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Ayat;
use App\Models\Bookmark;
use App\Models\Surat;
use App\Models\Tahlil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TahlilController extends Controller
{
    public function index(){
        $tahlil = Tahlil::all();
        $surat = Surat::where("indo","Yasin")->first();
        $yasin = Ayat::with(['bookmark','surat'])->where("surat_id",$surat->nomer_surah)->get();
        $user = Auth::user();
        $bookmarkedDoas = [];
        foreach ($yasin as $ayat) {
            $bookmarks = $ayat->bookmark;
            $data = false;
            // \var_dump($bookmark);
            // break;
            foreach($bookmarks as $bookmark) {
                if ($bookmark !== null && $user !== null) {
                    if($bookmark->user_id == $user->id){
                        // $bookmarkedDoas[] = $doa;
                        $data = true;
                    }
                }
            }
            $bookmarkedDoas[] = $data;
        }
        return Inertia::render("User/Categories/Tahlil", [
            "tahlils"=> $tahlil,
            // "yasin"=> $surat
            "yasin"=> $yasin,
            "dataBookmarkDoa" => $bookmarkedDoas
        ]);
    }
}
