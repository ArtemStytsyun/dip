<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class IndexController extends Controller
{
    public function __invoke() {

        $mainImages = Image::inRandomOrder()->limit(10)->get();
        $userBoards = null;
        $subscribesImages = null;
        $boards = null;
       
        // dd ($subscribesImages);
        // dd ($subscribes);
        // foreach ($subscribes as $subscribe) {
        //     foreach ($subscribe->boards as $board) {
        //         array_pusch($subscribesImages, );$board->images()->inRandomOrder()->limit(10)->get();
        //         dd()
        //     }
        // }

        if(Auth::check()) {
            $userBoards = Auth::user()->boards;
            $subscribes = Auth::user()->subscriptions;
            if ($subscribes != null) {
                foreach ($subscribes  as $subscribe) {
                    // dd ($subscribe->id);
                    $subscribesImages = Image::where('user_id', $subscribe->id)->orderBy('created_at')->limit(50)->get();
                }
            }
            

            $boards = [];

            foreach ($userBoards as $board) {
                // dd($board->images);
                $response = Http::post('http://localhost:5001/boards', [
                    'images' => $board->images
                ]);
        
                $data = json_decode($response->body());
                $images = [];
                foreach ($data as $dataImage) {
                    // dd(str_replace('/','\\',str_replace('..\storage\app\public\\','', $dataImage[0])));
                    $similarImage = Image::where('path', str_replace('\\','/',str_replace('..\storage\app\public\\','', $dataImage[0])))->first();
                    if ($similarImage != null) {
                        array_push($images, $similarImage);
                    } 
                }
                array_push($boards, $images);
            }
            // dd ($boards);
        }
        return view('index', compact('mainImages','userBoards','subscribesImages', 'boards'));        
    }
}
