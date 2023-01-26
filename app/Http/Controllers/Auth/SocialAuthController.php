<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\ManagementAccess\DetailUser;


class SocialAuthController extends Controller
{

    /**
     *  Redirect the user to the Google authentication page
     * 
     * @return \Illuminate\Http\Response
     */
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * 
     */
    public function handleProviderCallback()
    {
        try {

            $callback = Socialite::driver('google')->user();
        } catch (\Throwable $th) {

            return redirect(route('login'));
        }

        // check if they're an existing user
        $user = User::where('email', $callback->email)->first();

        if ($user) {

            if ($user->email == $callback->email && Hash::check($callback->email, $user->password)) {

                Auth::login($user, true);
                return redirect(route('index'));
            } else {

                return redirect('login')->with('status', 'Email used');
            }
        } else {

            $user = DB::transaction(function () use ($callback) {
                $data = [
                    'name' => $callback->getName(),
                    'email' => $callback->getEmail(),
                    'password' => Hash::make($callback->getEmail()),
                ];

                $user = User::create($data);

                // synchronized to role 
                $user->role()->sync(5);

                // create details user
                $detail_user = new DetailUser;
                $detail_user->user_id = $user->id;
                $detail_user->type_user_id = 3;
                $detail_user->contact = NULL;
                $detail_user->address = NULL;
                $detail_user->photo = $callback->getAvatar();
                $detail_user->gender = NULL;

                $detail_user->save();

                return $user;
            });
        }

        Auth::login($user, true);
        return redirect(route('index'));
    }
}
