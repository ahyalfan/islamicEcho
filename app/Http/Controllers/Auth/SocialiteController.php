<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        try {
            $socialUser = Socialite::driver($provider)->user(); //kita ambil user yg sudah melakukan login dengan ptovidermasing masing
            // \dd($socialUser);
            $user = User::where("email",'=', $socialUser->email)->first();
            if($user){
                Auth::login($user);
                return redirect()->route('home')->with('success','Success Login');
            }else{
                $passwordNew = Str::random(12);
                $user = User::Create([
                                "name"=> $passwordNew,
                                "email"=> $socialUser->email,
                                "provider_token"=> $socialUser->provider_token,
                                "provider_token_refresh" => $socialUser->refersh_token,
                                'provider' => $provider,
                                "password" => $passwordNew
                            ]);
                        $user->sendEmailVerificationNotification();
                        
                        $user->update([
                            'name' => $socialUser->name,
                        ]);
                        Auth::login($user);
                        return redirect()->route('home')->with('success','Success Login');
            }
        } catch (\Exception $th) {
            return \redirect()->route('login')->with('error', $th->getMessage());
            // return throw $th;
        }
    }

    // ini agak salah
    // public function callback($provider){
    //     try {
    //         // \dd(Socialite::driver($provider));
    //         $socialUser = Socialite::driver($provider)->user(); //kita ambil user yg sudah melakukan login dengan ptovidermasing masing
    //         // \dd($socialUser);
    //         if(User::where("email",'!=', $socialUser->email)){    
    //             $user = User::Create([
    //                 "name"=> $socialUser->name,
    //                 "email"=> $socialUser->email,
    //                 "provider_token"=> $socialUser->provider_token,
    //                 "provider_token_refresh" => $socialUser->id,
    //                 'provider' => $provider
    //             ]);
    //             User::create([
    //                 'passsword' => \bcrypt(Str::random(10)),
    //             ]);
    //             Auth::login($user);
    //             return redirect()->route('dashboard')->with('success','Success Login');
    //         }
    //     return redirect(\route("login"))->with("gagal","gagal");
    //     } catch (\Exception $th) {
    //         return \redirect()->route('login')->with('error', $th->getMessage());
    //         // return throw $th;
    //     }
    // }
}
