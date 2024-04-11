<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\Object_;
use SebastianBergmann\Type\ObjectType;

class BookmarkController extends Controller
{
    public function index(){
        $user = Auth::user();
        // $bookmarks = Bookmark::with(['ayat','doa','hadist','user'])->where("user_id", Auth::user()->id)->get();
        $ayatBookmarks = Bookmark::with(['ayat','doa','hadist','user'])->where("user_id", Auth::user()->id)->where('content_type',"ayat")->get();
        $doaBookmarks = Bookmark::with(['ayat','doa','hadist','user'])->where("user_id", Auth::user()->id)->where('content_type',"doa")->get();
        $hadistBookmarks = Bookmark::with(['ayat','doa','hadist','user'])->where("user_id", Auth::user()->id)->where('content_type',"hadist")->get();

        // ini bisa pakai eloquent
        // misal kita mau ambil surat dari relasi bookmark sedangkan bookmark hanya bereelasi dengan ayat. disini kita bisa memanfaatkan fitur di laravel yg mana jika kita ingin mengambil nilai surat bisa with ayat.surat
        $surat = [];
        foreach ($ayatBookmarks as $index => $value) {
            $surat[] = $value->ayat->surat;
        }
        $doas = [];
        foreach ($doaBookmarks as $index => $value) {
            $doas[] = $value->doa->categori_doa;
        }
        return Inertia::render("User/Bookmark",[
            "ayatBookmarks" => $ayatBookmarks,
            "doaBookmarks" => $doaBookmarks,
            "hadistBookmarks" => $hadistBookmarks,
            "surat" => $surat,
            "doas" => $doas,
        ]);
    }

    // ini divue sama bookmark controllernya masih kurang baik karena jika di add maka akan refresh dan jika di delete maka harus direfresh
    public function add(Request $request) {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route("login");
        }
        $bookmark = new Bookmark();
        $bookmark->user_id = $user->id;
        $bookmark->content_id = $request->id;
        if ($request->type == "doa") {
            $bookmark->content_type = "doa";
            $bookmark->doa_id = $request->id;
            $bookmark->save();
        }else if ($request->type == "ayat") {
            $bookmark->content_type = "ayat";
            $bookmark->ayat_id = $request->id;
            $bookmark->save();
        }else {
            $bookmark->content_type = "hadist";
            $bookmark->hadist_id = $request->id;
            $bookmark->save();
        }
        return response()->json([
            "message" => "success",
        ],200);
    }

    public function delete(Request $request) {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route("login");
        }
        if ($request->type == "doa") {
            Bookmark::where("doa_id",$request->id)->where("user_id", $user->id)->delete();
        }else if ($request->type == "ayat") {
            Bookmark::where("ayat_id",$request->id)->where("user_id", $user->id)->delete();
        }else {
            Bookmark::where("hadist_id",$request->id)->where("user_id", $user->id)->delete();
        }
        return response()->json([
            "message" => "success",
        ],200);
    }
}
