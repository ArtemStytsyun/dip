<?php
namespace App\Http\Controllers\Image;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function __invoke($id) {
        $image = Image::find($id);
        $comments = $image->comments;
        $likedUsers = $image->likedUsers;
        $isSaveInBoardUser = false;
        $user = $image->user;

        $number = 5; // Наше число, которое мы хотим передать в микросервис
        
        $response = Http::post('http://localhost:5000/images', [
            'path' => $image->path
        ]);

        $data = json_decode($response->body());
        $images = [];
        foreach ($data as $dataImage) {
            $similarImage = Image::where('path', 'usersImages/' . $dataImage[0])->first();
            if ($similarImage != null) {
                array_push($images, $similarImage);
            } 
        }
        if (Auth::check()) {
            if($image->user->id == Auth::user()->id) {
                return view('image.index', compact('image', 'comments', 'likedUsers', 'images'));
            }
            else {
                $userBorards = Auth::user()->boards;
                $imageBoards = $image->boards;
                foreach ($imageBoards as $imageBoard) {
                    foreach ($userBorards as $userBorard)
                    if($userBorard->id == $imageBoard->id) {
                        $isSaveInBoardUser = true;
                        break;
                    }
                }               
                return view('image.show', compact('image', 'comments', 'likedUsers', 'isSaveInBoardUser', 'images', 'user'));
            } 
        } else {
            return view('image.show', compact('image', 'comments', 'likedUsers', 'isSaveInBoardUser', 'images', 'user'));
        }
    }
}
