<?php

namespace App\Http\Controllers\Image\Like;

use App\Models\BoardImage;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke($id) {
        $user = Auth::user();
        $image = Image::find($id);
      
        if($user->likedImages()->find($image)){
            //Убираем лайк
            $user->likedImages()->detach($image->id);
        }
        else{
            $user->likedImages()->attach($image->id);
        }
        return redirect()->route('image.index', $image->id);

    }
}
