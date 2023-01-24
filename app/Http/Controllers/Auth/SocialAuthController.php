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
            $user = Socialite::driver('google')->user();
        } catch (\Throwable $th) {
            return redirect(route('login'));
        }


        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();


        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {

            try {
                //code...
                return DB::transaction(function () use ($user) {
                    return tap(User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => Hash::make($user->email),

                        //take user avatar from image
                        $photo = $user->avatar
                    ]), function (User $user) use ($photo) {

                        // add to role user data
                        $user->role()->sync(5);

                        // add to detail users
                        $detail_user = new DetailUser;
                        $detail_user->user_id = $user->id;
                        $detail_user->type_user_id = 3;
                        $detail_user->contact = NULL;
                        $detail_user->address = NULL;
                        $detail_user->photo = $photo;
                        $detail_user->gender = NULL;

                        $detail_user->save();
                    });
                });
            } catch (\Throwable $th) {
                //throw $th;
                return redirect(route('login'));
            }
        }

        return redirect(route('index'));
    }
}
