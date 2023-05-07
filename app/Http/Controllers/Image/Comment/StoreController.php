<?php

namespace App\Http\Controllers\Image\Comment;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function __invoke(Image $image) {
        $data = request()->validate([
            'text'=>'string|required'
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['image_id'] = $image->id;

        if(Auth::check()) {
            Comment::create($data);
            return redirect()->route('image.index', $image->id);
        }
        else {
            
        }
    }
}
