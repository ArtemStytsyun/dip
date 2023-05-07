<?php

namespace App\Http\Controllers\Image;

use App\Models\BoardImage;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class StoreController extends Controller
{
    public function __invoke() {
        $data = request()->validate([
            'name'=> 'required|string',
            'description'=>'required|string',
            'board_id'=>'required|string',
            'image' => 'image',
        ]);
        $path = $data['image']->store('usersImages', 'public');
        $board = $data['board_id'];

        $data['path'] = $path;
        $data['user_id'] = Board::find($board)->user_id;

        unset($data['image']);
        unset($data['board_id']);

        if(Auth::check() && Board::find($board)->user_id = Auth::user()->id) {
            $image = Image::create($data);
            $image->boards()->attach($board);
            // BoardImage::firstOrCreate([
            //     'image_id'=>$image->id,
            //     'board_id'=>$board,
            // ]);
            return redirect()->route('board.index', $board);
        }
        else {
            //404
        } 
    }
}
