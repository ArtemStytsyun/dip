<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SemilarImagesBoardController extends Controller
{
    public function __invoke($id) {

        $image = Image::find($id);
        if(Auth::check()) {
            $response = Http::post('http://localhost:5000/boards', [
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
        }
    }
}
