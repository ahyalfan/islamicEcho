<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookmarkController extends Controller
{
    public function index(){
        $bookmarks = Bookmark::where("user_id", Auth::user()->id)->get();
        return Inertia::render("User/Bookmark",compact("bookmarks"));
    }
}
