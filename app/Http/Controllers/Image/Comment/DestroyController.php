<?php

namespace App\Http\Controllers\Comment;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DestroyController extends Controller
{
    public function __invoke($id) {
        $user = Board::find($id)->user;
        $board = Board::find($id);
      
        if(Auth::id() == $user->id){
            $board->delete();
            return redirect()->route('user', $user->id);
        }
        else{
            //404
        }
    }
}
