@extends('layouts.app')
@section('content')
    {{$board}}
    @foreach ($board->images as $image)
        <a href="{{route('image.index', $image->id)}}">{{$image->name}}Картинка</a>
    @endforeach
@endsection('content')