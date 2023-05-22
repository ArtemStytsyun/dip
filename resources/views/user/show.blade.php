@extends('layouts.app')
@section('content')
    <div class=" uk-flex uk-flex-middle uk-flex-right uk-flex-center uk-flex-column">
        <div class="profile-info">
            <div>
                <img class="profile-image" src="{{asset('/storage/' . $user->image)}}" alt="">
            </div>

            <div class="profile-name">
                <h3 class="uk-text-center uk-margin-small-top">{{$user->name}}</h3>
            </div>

            <div class="profile-description uk-margin">
                <p class="uk-text-center">{{$user->description}}</p>
            </div>

            <div class="profile-subscriptions">
                <p class="uk-text-center">подписок: {{count($user->subscriptions)}}</p> 
                <p class="uk-text-center">подписчиков: {{count($user->subscribers)}}</p>
            </div>
        </div>
        <div class="uk-flex uk-flex-center uk-margin-top">
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
    </div>
    <div uk-grid class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-match uk-width-1-1 uk-margin-large-top" >
        @foreach ($boards as $board )
            <a href="{{route('board.index', $board->id)}}">
                <div class="uk-card uk-card-default uk-card-small uk-card-hover uk-card-body board-card">\
                    @if ($board->images()->count() > 2) 
                            <div class="board-box">
                                <div class="board-box-image">
                                    <img src="{{asset('/storage/' . $board->images[0][0]->path)}}" alt="">
                                </div>
                                <div class="board-box-image">
                                    <img src="{{asset('/storage/' . $board->images[0][1]->path)}}" alt="">
                                </div>
                                <div class="board-box-image">
                                    <img src="{{asset('/storage/' . $board->images[0][2]->path)}}" alt="">
                                </div>
                            </div>
                        @endif
                    <p>{{$board->name}}</p>
                    <p>{{$board->description}}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection('content')