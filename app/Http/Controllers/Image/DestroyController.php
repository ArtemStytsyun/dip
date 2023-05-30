<?php

namespace App\Http\Controllers\Image;

use App\Models\BoardImage;
use App\Models\Image;
use App\Models\Board;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{
    public function __invoke($id) {
        $user = Image::find($id)->user;
        $image = Image::find($id);
      
        if(Auth::id() == $user->id){
            BoardImage::find('board_id');
            $boards = Board::all();
            // $boards = $boards
            $image->boards()->detach($image->boards);
            unlink('..\storage\app\public\\' . $image->path);
            $image->delete();
            return redirect()->route('user', $user->id);
        }
        else{
            //404
        }
    }
}
