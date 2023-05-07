<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RemoveController extends Controller
{
    public function __invoke($id) {
        // $data = request()->validate([
        //     'board_id'=>'string|required'
        // ]);

        if (Auth::check()) {
            $image = Image::find($id);
            $UserBoards = Auth::user()->boards;
            $image->boards()->detach($UserBoards);
        }

        return redirect()->route('board.index', Auth::user()->id);
    }
}