<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        try {
            // \dd(Socialite::driver($provider));
            $socialUser = Socialite::driver($provider)->user(); //kita ambil user yg sudah melakukan login dengan ptovidermasing masing
            // \dd($socialUser);
            if(User::where("email",'!=', $socialUser->email)){    
                $user = User::Create([
                    "name"=> $socialUser->name,
                    "email"=> $socialUser->email,
                    "provider_token"=> $socialUser->provider_token,
                    "provider_token_refresh" => $socialUser->id,
                    'provider' => $provider
                ]);
                Auth::login($user);
                return redirect()->route('dashboard')->with('success','Success Login');
            }
        return redirect(\route("login"))->with("gagal","gagal");
        } catch (\Exception $th) {
            return \redirect()->route('login')->with('error', $th->getMessage());
            // return throw $th;
        }
    }
}
