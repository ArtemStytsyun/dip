<?php
namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Http\Models\Image;
use App\Http\Models\Board;

use App\Http\Controllers\Controller;
class EditController extends Controller
{
    public function __invoke($id) {
        return $id;
    }
}
