<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke() {

        $images = Image::all();
        $boards = Board::all();
        
        return view('index', compact('images','boards'));        
    }
}
