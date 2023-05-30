<?php
namespace App\Http\Controllers\Image;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke($id) {
        return $id;
    }
}
