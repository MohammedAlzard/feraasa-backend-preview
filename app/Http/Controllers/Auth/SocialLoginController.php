<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\HelpersFun;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\File;

class SocialLoginController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = url('/home');
    }

    public function redirect($provider) {

        return Socialite::driver($provider)->redirect();
    }

    public function handleCallback($provider) {

        try {
            $user = Socialite::driver($provider)->user();
            $finduser = User::where('provider_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
                $auth = Auth::user();
                $auth->update([
                    'email_verified_at' => Carbon::now()
                ]);

                return redirect('/home');
            }else{
                $file_name = '/uploads/user/profile/' . time() . uniqid() . '.jpg';
                $fileContents = file_get_contents($user->getAvatar());
                File::put(public_path() . $file_name, $fileContents);


                if ($provider == 'facebook'){
                    $first_name = explode(' ', $user->name)[0];
                    $last_name = ltrim($user->name, explode(' ', $user->name)[0]);
                }else{
                    $first_name = $user->user['given_name'];
                    $last_name = $user->user['family_name'];
                }
                $username = Str::slug($user->user['name']);
                $oldUser = User::where('username', $username)->first();

                $userCheck = User::where('email', $user->email)->first();
                if ($userCheck){
                    $userCheck->update([
                        'email_verified_at' => empty($userCheck->email_verified_at) ? Carbon::now() : $userCheck->email_verified_at,
                        'provider'=> $provider,
                        'provider_id'=> $user->id,
                        'provider_token'=> $user->token,
                    ]);
                }else{
                    $newUser = User::create([
                        'avatar' => $file_name,
                        'username' => $oldUser ? $username.'-'.Str::random(4) : $username,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $user->email,
                        'email_verified_at' => Carbon::now(),
                        'password' => Hash::make(Str::random(8)),
                        'provider'=> $provider,
                        'provider_id'=> $user->id,
                        'provider_token'=> $user->token,
                    ]);
                }

                $stripeCustomer = $newUser->createOrGetStripeCustomer([
                    'name' => $newUser->first_name . ' ' . $newUser->last_name,
                    'phone' => $newUser->phone
                ]);
                $newUser->update([
                    'customer_id' => $stripeCustomer->id
                ]);

                Auth::login($newUser);
                return redirect('/home');
            }

        } catch (\Exception $e) {
            return redirect('/login')->withErrors([
                'email' => 'Please try again.',
            ]);
        }
    }
}
