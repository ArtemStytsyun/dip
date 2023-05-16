<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke($id) {

        // $user = User::find($id);
        // $boards = $user->boards;
        // $likedImages = $user->likedImages;

        $data = request()->validate([
            'name'=> 'required|string',
            'description'=>'required|string',
            'image'=>'image'
        ]);

        if(Auth::check()) {
            $user = User::find(Auth::user()->id);

            if ($user == null) {
                return;
            }

            if (isset($data['image'])) {
                $image = $data['image']->store('profilesImages', 'public');
                $data['image'] = $image;
            }
           
            $user->update($data);
            return redirect()->route('user', $user->id);
        }
        else {
            //404
        }
    }
}
