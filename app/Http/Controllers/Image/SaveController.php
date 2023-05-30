<?php

namespace App\Http\Controllers\Image;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SaveController extends Controller
{
    public function __invoke($id) {
        $data = request()->validate([
            'board_id'=>'string|required'
        ]);

        if (Auth::check()) {
            $image = Image::find($id);
            $board = Auth::user()->boards()->find($data['board_id']);
            $UserBoards = Auth::user()->boards;
            $image->boards()->detach($UserBoards);
            $image->boards()->attach($board);
        }

        return redirect()->route('image.index', $image->id);
    }
}