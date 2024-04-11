<?php

namespace App\Http\Controllers\Categories;

use App\Helper\History;
use App\Http\Controllers\Controller;
use App\Models\StoryNabi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StoryController extends Controller
{
    public function index(){
        $story = StoryNabi::all();
        return Inertia::render("User/Categories/Story", [
            "story"=> $story
        ]);
    }

    public function detail($id){
        $story = StoryNabi::find($id);
        $user = Auth::user();
        {   //hsitory
            $history = History::getHistory();
            $isHistoryExists = false;
            $i = 0;
            foreach ($history as $item) {
                if ($history[$i]['id'] === $story->id && $history[$i]['type'] === $story->type) {
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
                    'id' => $story->id,
                    'type' => $story->type,
                    'name'=> $story->name
                ];
            }
            History::setHistory($history); // kita akan set cartItem nya kedalam cookie
        }
        return Inertia::render("User/Detail/Story", [
            "story"=> $story,
        ]);
    }
}
