<?php

namespace App\Http\Controllers\Board;

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
            'description'=>'required|string'
        ]);

        if(Auth::check()) {
            $data['user_id'] = Auth::user()->id;
            Board::create($data);

            return redirect()->route('user', Auth::user()->id);
        }
        else {
            //404
        }
    }
}
