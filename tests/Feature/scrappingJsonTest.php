<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class scrappingJsonTest extends TestCase
{
   public function test_scrapping_json(){
    $data = Http::get("https://raw.githubusercontent.com/kopen1/isline/master/src/data/listsurah.json");
    $this->assertEquals(200, $data->status());
    \var_dump($data[0]);
   }
}
