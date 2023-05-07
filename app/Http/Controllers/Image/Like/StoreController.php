<?php
namespace App\Http\Controllers\Image\Like;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function __invoke(Image $image) {
    
        $likes = $image->comments;
        if($image->user->id == Auth::user()->id) {

        }
        else {
    
        } 
    }
}
