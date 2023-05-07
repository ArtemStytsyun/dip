<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class IndexController extends Controller
{
    public function __invoke($id) {
        $image = Image::find($id);
        $comments = $image->comments;
        $likedUsers = $image->likedUsers;

        if($image->user->id == Auth::user()->id) {
            return view('image.index', compact('image', 'comments', 'likedUsers'));
        }
        else {
            $userBorards = Auth::user()->boards;
            $imageBoards = $image->boards;
            $isSaveInBoardUser = false;
            foreach ($imageBoards as $imageBoard) {
                foreach ($userBorards as $userBorard)
                if($userBorard->id == $imageBoard->id) {
                    $isSaveInBoardUser = true;
                    break;
                }
            }

            return view('image.show', compact('image', 'comments', 'likedUsers', 'isSaveInBoardUser'));
        } 
    }
}
