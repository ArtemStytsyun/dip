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
      
        $number = 5; // Наше число, которое мы хотим передать в микросервис

        // Отправляем POST-запрос на микросервис и передаем туда наше число
        $response = Http::post('http://localhost:5000/api/get_number', [
            'number' => $number
        ]);

        // Декодируем JSON-ответ от микросервиса
        $data = json_decode($response->body());

        // Выводим полученное число на экран
        dd($data->number);

    
        // if($image->user->id == Auth::user()->id) {
        //     return view('image.index', compact('image', 'comments', 'likedUsers'));
        // }
        // else {
        //     $userBorards = Auth::user()->boards;
        //     $imageBoards = $image->boards;
        //     $isSaveInBoardUser = false;
        //     foreach ($imageBoards as $imageBoard) {
        //         foreach ($userBorards as $userBorard)
        //         if($userBorard->id == $imageBoard->id) {
        //             $isSaveInBoardUser = true;
        //             break;
        //         }
        //     }
            
        //     return view('image.show', compact('image', 'comments', 'likedUsers', 'isSaveInBoardUser'));
        // } 
    }
}
