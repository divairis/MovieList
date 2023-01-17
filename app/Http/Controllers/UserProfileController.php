<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Storeuser_profileRequest;
use App\Http\Requests\Updateuser_profileRequest;

class UserProfileController extends Controller
{
    public function show()
    {
        $user_id = Auth::user()->user_id;
        $user = User::with('user_profile')->find($user_id);

        if(user_profile::where('user_id', $user_id)->exists()){
            $data = [
                'user_id' => $user->user_id,
                'email_address' => $user->email_address,
                'username' => $user->username,
                'dob' => $user->user_profile->dob,
                'phone' => $user->user_profile->phone,
                'image_url' => $user->user_profile->image_url
            ];
        }else{
            $data = [
                'user_id' => $user->user_id,
                'email_address' => $user->email_address,
                'username' => $user->username,
                'dob' => '',
                'phone' => '',
                'image_url' => ''
            ];
        }

        return view('profile.upreate', $data);
    }

    public function upsert(Storeuser_profileRequest $request)
    {
        $user_id = $request->user_id;
        $condition = ['user_id' => $user_id];

        if($request->image_url){
            $upsert = ['image_url' => $request->image_url];
            session(['url' => $request->image_url]);
        }else{
            $user = User::find($user_id);
            $data_update = [
                'username' => $request->username,
                'email_address' => $request->email
            ];
            $user->update($data_update);

            $upsert = 
                [
                    'dob' => $request->dob,
                    'phone' => $request->number,
                ];
        }
        
        user_profile::updateOrCreate($condition, $upsert);

        return redirect()->back();
    }
}
