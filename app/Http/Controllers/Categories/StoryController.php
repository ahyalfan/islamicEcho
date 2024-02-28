<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\StoryNabi;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoryController extends Controller
{
    public function index(){
        $story = StoryNabi::all();
        return Inertia::render("User/Categories/Story", [
            "story"=> $story
        ]);
    }
}
