@extends('layouts.app')
@section('content')
    <div>
        @if (!$user->subscribers()->find(Auth::user()->id)) 
            <form action="{{route('user.subscribe', $user->id)}}" method="POST">
                @csrf
                <button class="uk-button uk-button-default uk-button-small uk-margin-small-right uk-margin-small-left" type="submit" name='user-subscribe'>Подписаться</button>
            </form> 
        @else
            <form action="{{route('user.unsubscribe', $user->id)}}" method="POST">
                @csrf
                <button class="uk-button uk-button-default uk-button-small uk-margin-small-right uk-margin-small-left" type="submit" name='user-unsubscribe'>Отписаться</button>
            </form> 
        @endif
    </div>
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