<?php
namespace App\Http\Controllers\Image\Comment;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class UpdateController extends Controller
{
    public function __invoke($id) {

        $user = Board::find($id)->user;
        $board = Board::find($id);

        $data = request()->validate([
            'name'=> 'required|string',
            'description'=>'required|string'
        ]);

        if(Auth::check() && $user->id == Auth::user()->id) {
            $board->update($data);
            return redirect()->route('image.index', $board->id);
        }
        else {
            //404
        }
    }
}
