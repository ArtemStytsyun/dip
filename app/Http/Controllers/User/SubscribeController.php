<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function __invoke($id) {
        $user = User::find($id);
       
        $user->subscribers()->attach(Auth::user()->id);
        return redirect()->route('user', $user->id);
       
    }
}
