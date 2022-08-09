<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('biodata.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,'. $user->id,
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        $data = $request->all();
        
        if($request->file('avatar')){
            $image = $request->file('avatar');
            
            if(Storage::exists($user->avatar)){
                Storage::delete($user->avatar);
            };

            $pathBaru = $image->store('public/assets/profile/'. $user->id);
            $data['avatar'] = $pathBaru;
        };

    
        $user->update($data);

        return back()->with('success', 'Biodata Has Been Update');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password'  => 'required|alpha_num'
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success', 'Password Has Been Update');
    }
}
