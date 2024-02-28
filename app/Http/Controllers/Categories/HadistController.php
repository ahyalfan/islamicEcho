<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\HadistCollection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HadistController extends Controller
{
    public function index(){
        $hadistCollection = HadistCollection::all();
        return Inertia::render("User/Categories/Hadist", [
            "hadisCollection"=> $hadistCollection
        ]);
    }
}
