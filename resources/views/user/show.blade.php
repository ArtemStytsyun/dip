@extends('layouts.app')
@section('content')
    <div uk-grid class="uk-child-width-1-3@s uk-grid-match" >
        @foreach ($boards as $board )
            <a href="{{route('board.index', $board->id)}}">
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <h3 class="uk-card-title">{{$board->name}}</h3>
                    <p>{{$board->description}}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection('content')