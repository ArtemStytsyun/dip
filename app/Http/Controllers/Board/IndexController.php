<?php

namespace App\Http\Controllers\Board;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke($id) {
        
        $user = Board::find($id)->user;
        $board = Board::find($id);
        // dd($board->images);
        

        if(Auth::id() == $user->id){
            return view('board.index', compact('board', 'user'));
        }
        else{
            // $board->images = array($board->images);
            return view('board.show', compact('board', 'user'));
        }
    }
}
