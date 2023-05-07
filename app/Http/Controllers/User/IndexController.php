<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke($id) {

        $user = User::find($id);
        $boards = $user->boards;
        $likedImages = $user->likedImages;
        
        foreach($boards as $board) {
            $board->images = array($board->images);
        } 

        if(Auth::id() == $id){
            return view('user.index', compact('boards', 'likedImages'));
        }
        else{
            return view('user.show', compact('boards', 'user'));
        }
    }
}
