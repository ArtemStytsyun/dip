@extends('layouts.app')
@section('content')
<div class="uk-flex uk-flex-middle uk-flex-center uk-flex-column">
    <h3>{{$board->name}}</h3>
    <p class="uk-margin-small-top text-description">{{$board->description}}</p>
    <div class="uk-margin-large-top">
        <p>{{count($board->images)}} изображений</p>
    </div>

    <div class="width-100 uk-flex uk-flex-column uk-flex-middle">
        <ul uk-tab class="uk-margin-large-top max-width-300">
            <li class><a href="">Созданные</a></li>
            <li class><a>Сохраненные</a></li>
        </ul>

        <ul class="uk-switcher uk-margin-top">
            <li>
                <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-small" uk-grid="masonry: true"> 
                    @foreach ($board->images as $image)
                        @if ($image->user->id == $user->id)
                        <a href="{{route('image.index', $image->id)}}">
                            <img class="uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle image-card" src="{{asset('/storage/' . $image->path)}}" alt="">
                            <p>{{$image->name}}</p>
                            <p>{{$image->user->id}}</p>
                        </a>
                        @endif
                    @endforeach
                </div>
            </li>
            <li>
                <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-small" uk-grid="masonry: true"> 
                    @foreach ($board->images as $image)
                        @if ($image->user->id != $user->id)
                        <a href="{{route('image.index', $image->id)}}">
                            <img class="uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle image-card" src="{{asset('/storage/' . $image->path)}}" alt="">
                            <p>{{$image->name}}</p>
                            <p>{{$image->user->id}}</p>
                        </a>
                        @endif
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection('content')