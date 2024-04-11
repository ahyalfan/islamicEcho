<?php

namespace App\Http\Controllers;

use App\Helper\History;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){
        $history = History::getHistory();
        $countHistory = count($history);
        if($countHistory > 5){
            // modif cookie menjadi makasimal 5 harusnya
            // tapi masih bingung
        }
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'history' => array_reverse($history),
        ]);
    }
}