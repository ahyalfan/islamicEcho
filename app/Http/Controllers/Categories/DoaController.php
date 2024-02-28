<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\CategoryDoa;
use App\Models\Doa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DoaController extends Controller
{
    public function index(){
        $doa = CategoryDoa::all();
        return Inertia::render("User/Categories/Doa", [
            "listDoa"=> $doa
        ]);
    }
}
