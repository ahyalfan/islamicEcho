<?php

namespace App\Http\Controllers\Categories;

use App\Helper\History;
use App\Http\Controllers\Controller;
use App\Models\CategoryDoa;
use App\Models\Doa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DoaController extends Controller
{
    public function index(){
        $doa = CategoryDoa::all();
        return Inertia::render("User/Categories/Doa", [
            "listDoa"=> $doa
        ]);
    }

    public function detail($id){
        $user = Auth::user();
        $doas  = Doa::with(['categori_doa',"bookmark"])->where("category_id",$id)->get();
        $bookmarkedDoas = [];
        foreach ($doas as $doa) {
            $bookmarks = $doa->bookmark;
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

        return Inertia::render("User/Detail/doa", [
            "doas"=> $doas,
            "dataBookmarkDoa" => $bookmarkedDoas
        ]);
    }
}
