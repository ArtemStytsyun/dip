<?php

namespace App\Http\Controllers\Image;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RemoveController extends Controller
{
    public function __invoke($id) {

        if (Auth::check()) {
            $image = Image::find($id);
            $UserBoards = Auth::user()->boards;
            $image->boards()->detach($UserBoards);
        }

        return redirect()->route('board.index', Auth::user()->id);
    }
}