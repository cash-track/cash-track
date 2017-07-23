<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request, RedirectResponse
};
use App\Models\User;
use Storage;

trait ProfileSettingUpdateHandlers{

    /**
     * Update profile password
     *
     * @param Request $request
     * @param User $user
     * @param string $action
     * @return RedirectResponse
     */
    private function updatePassword(Request $request, User $user, string $action) :RedirectResponse
    {
        // validate old password
        if(!\Hash::check($request->get('old-password'), $user->password)){
            // old password not valid
            return back()
                ->with($action.'-error', 'Old password is not valid')
                ->withInput();
        }

        // validate form request
        $validator = \Validator::make($request->all(), [
            'old-password' => 'required',
            'password'     => 'required|min:6|max:100|confirmed'
        ]);

        // throw if error
        if($validator->fails()){
            return back()
                ->withErrors($validator, $action)
                ->withInput();
        }

        // update password on user
        $user->fill([
            'password' => \Hash::make($request->password)
        ]);

        if($user->save()){
            return back()->with($action.'-success', 'Password has been updated');
        }

        return back()->with($action.'-error', 'Password not updated');
    }

    /**
     * Update general profile info (name, image, etc..)
     *
     * @param Request $request
     * @param User $user
     * @param string $action
     * @return RedirectResponse
     */
    private function updateProfileInfo(Request $request, User $user, string $action) :RedirectResponse
    {
        // upload photo here
        $validator = \Validator::make($request->all(), [
            'name'      => 'string',
            'nick'      => 'alpha_dash|unique:users,nick,'.$user->id,
            'last_name' => 'string',
            'image'     => 'image|max:3072'
        ]);

        // throw if error
        if($validator->fails()){
            return back()
                ->withErrors($validator, $action)
                ->withInput();
        }

        // move uploaded image to needle directory and build relative path
        if($request->hasFile('image')){
            $result = null;
            try{
                $result = $request->file('image')->storePublicly('public/profile-images');
                $result = str_replace('public/', '/storage/', $result);
            }catch(\Exception $e){
                return back()
                    ->with($action.'-error', 'Error on uploading file. '.$e->getMessage());
            }

            $user->image = $result;
        }

        // update user name if given
        if($user->name != $request->get('name'))
            $user->name = $request->get('name');

        if($user->last_name != $request->get('last_name'))
            $user->last_name = $request->get('last_name');

        if($request->has('nick') && $request->get('nick') != $user->nick)
            $user->nick = str_slug($request->get('nick'));

        if($user->save())
            return back()->with($action.'-success', 'Profile info updated');

        return back()->with($action.'-error', 'Error in update profile info');
    }
}