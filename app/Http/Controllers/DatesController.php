<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class DatesController extends Controller
{

    public function index()
    {
        // harusnya get api buat mengambil hari liburnya

        // dan bisa dikasih calander hijiriah

        // ini api waktu sholat
        $day = \date('j');
        $month = \date('n');
        $year = \date('Y');
        $response = Http::get("https://api.aladhan.com/v1/calendarByCity/$year/$month",[
            'city' => 'bojonegoro',
            'country' => 'indonesia',
        ]);
        $response = $response->json()['data'];
        return Inertia::render('User/Date',[
            'dates'=>$response,
        ]);
    }
}
