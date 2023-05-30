<?php

namespace App\Http\Controllers\Image;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    public function __invoke($id) {
        $user = Image::find($id)->user;
        $image = Image::find($id);

        $data = request()->validate([
            'name'=> 'required|string',
            'description'=>'required|string'
        ]);

        if(Auth::check() && $user->id == Auth::user()->id) {
            $image->update($data);
            return redirect()->route('image.index', $image->id);
        }
        else {
            //404
        }
    }
    
}
