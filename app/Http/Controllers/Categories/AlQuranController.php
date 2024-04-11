<?php

namespace App\Http\Controllers\Categories;

use App\Helper\History;
use App\Http\Controllers\Controller;
use App\Models\Ayat;
use App\Models\Surat;
use App\Models\TafsirAyat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class AlQuranController extends Controller
{
    public function index(){
        $surats = Surat::with("ayat")->get();
        $keyCache = "key_buat_cache_data";
        $data = Cache::get($keyCache);
        if($data){
            return Inertia::render("User/Categories/Alquran", [
                "surat"=> $surats,
                "juz"=> $data,
            ]);
        } 

        $juz = [] ;
        for($i = 1; $i <= 30; $i++){
            $juz[] = Ayat::with('surat')->where('juz', $i)->selectRaw('surat_id,juz, COUNT(*) AS jumlah_ayat')->groupBy(['surat_id','juz'])->orderBy('surat_id','asc')->get();//
        }; 
              
        $data = $juz;
        Cache::put($keyCache,$data,3600);

        return Inertia::render("User/Categories/Alquran", [
            "surat"=> $surats,
            "juz"=> $juz,
        ]);
    }

    public function detail($id){
        $user = Auth::user();
        $surat = Surat::where(["id"=> $id])->with(["ayat","ayat.audio","ayat.tafsir"])->get();
        $ayats = Ayat::with(['bookmark'])->where(["surat_id"=> $id])->get();
        $bookmarkedDoas = [];
        foreach ($ayats as $ayat) {
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

        {   //hsitory
            $history = History::getHistory();
            $isHistoryExists = false;
            $i = 0;
            foreach ($history as $item) {
                if ($history[$i]['id'] === $surat[0]->id && $history[$i]['type'] === $surat[0]->type) {
                    // $item['id'] = 10;// ini tidak bisa entah mengapa
                    $history[$i]['user'] === $user;
                    $isHistoryExists = true;
                    break;
                }else{
                    $i += 1;
                    continue;
                }
            }

            if (!$isHistoryExists) {
                $history[] = [
                    'user' => $user,
                    'id' => $surat[0]->id,
                    'type' => $surat[0]->type,
                    'name'=> $surat[0]->indo
                ];
            }
            History::setHistory($history); // kita akan set cartItem nya kedalam cookie
        }
        return Inertia::render("User/Detail/Alquran", [
            "surat"=> $surat,
            // "ayats"=> $ayat,
            "dataBookmarkDoa" => $bookmarkedDoas
        ]);
    }
    public function detailjuz($id){
        $user = Auth::user();
        $ayats = Ayat::with(['bookmark','surat'])->where('juz',$id)->get();
        $bookmarkedDoas = [];
        foreach ($ayats as $ayat) {
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
        return Inertia::render("User/Detail/Alquranjuz", [
            "ayats"=> $ayats,
            'juz'=> $id,
            "dataBookmarkDoa" => $bookmarkedDoas
        ]);
    }

    public function detailTafsir($suratId,$noayat)
    {
        $user = Auth::user();
        $surat = Surat::find($suratId - 1);
        $ayats = Ayat::with(['bookmark','surat','tafsir'])->where(["nomer_ayat"=> $noayat,"surat_id"=>$suratId])->get();
        // $tafsirs = TafsirAyat::where(["ayat_id"=> $noayat,"surah"=>$suratId])->get();
        $bookmarkedDoas = [];
        foreach ($ayats as $ayat) {
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
        return Inertia::render("User/Detail/Tafsir", [
            "ayats"=> $ayats,            
            'dataprevsurat' => $surat,
            "dataBookmarkDoa" => $bookmarkedDoas
        ]);
    }
}
