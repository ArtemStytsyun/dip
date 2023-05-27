@extends('layouts.app')
@section('content')
<div>
    <ul uk-tab class="uk-margin-large-top">
        <li class><a href="">Главная</a></li>
        @guest
        @else
            <li class><a href="">Подписки</a></li>
            @if ($userBoards != null)
                @foreach ($userBoards as $board)
                    <li class><a href="">{{$board->name}}</a></li>
                @endforeach
            @endif
        @endguest
    </ul>
    <ul class="uk-switcher uk-margin-top uk-width-1-1">
        <li>
            <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-small" uk-grid="masonry: true">  
                @foreach ($mainImages as $image)
                    <a href="{{route('image.index', $image->id)}}">
                        <img class="uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle image-card" src="{{asset('/storage/' . $image->path)}}" alt="">
                        <p>{{$image->name}}</p>
                        <p>{{$image->user->name}}</p>
                    </a>
                @endforeach
            </div>
        </li>
        @guest
        @else
            <li>
                <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-small" uk-grid="masonry: true">  
                    @if ($subscribesImages != null)
                        @foreach ($subscribesImages as $image)
                            <a href="{{route('image.index', $image->id)}}">
                                <img class="uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle image-card" src="{{asset('/storage/' . $image->path)}}" alt="">
                                <p>{{$image->name}}</p>
                                <p>{{$image->user->name}}</p>
                            </a>
                        @endforeach
                    @endif
                </div>
            </li>

            @if ($boards != null)
                @foreach ($boards as $board)
                    <li>
                        <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-small" uk-grid="masonry: true">  
                            @foreach ($board as $image)
                                <a href="{{route('image.index', $image->id)}}">
                                    <img class="uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle image-card" src="{{asset('/storage/' . $image->path)}}" alt="">
                                    <p>{{$image->name}}</p>
                                    <p>{{$image->user->name}}</p>
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            @endif
        @endguest
    </ul>
</div>


    {{-- <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-small" uk-grid="masonry: true">  
        @foreach ($board->images as $image)
            @if ($image->user->id == Auth::user()->id)
                <a href="{{route('image.index', $image->id)}}">
                    <img class="uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle image-card" src="{{asset('/storage/' . $image->path)}}" alt="">
                    <p>{{$image->name}}</p>
                    <p>{{$image->user->id}}</p>
                </a>
            @endif
        @endforeach
    </div>
    --}}
@endsection('content')