<?php 
namespace App\Helper;

use Illuminate\Support\Facades\Cookie;

class History
{
    public static function setHistory(array $item)
    {
        Cookie::queue("history",\json_encode($item),60*24*7);
    }
    public static function getHistory()
    {
        return json_decode(request()->cookie('history', '[]'), true);
    }
    // public static function deleteHistory(){
    //     $history = self::getHistory();
    //     if(\count($history) > 10){

    //     }
    // }
}