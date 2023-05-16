@extends('layouts.app')
@section('content')
<div>
    <ul uk-tab class="uk-margin-large-top max-width-300">
        <li class><a href=""></a></li>
    </ul>
    <ul class="uk-switcher uk-margin-top">
        <li>

        </li>
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