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

            <div class="profile-description">
                <p class="uk-text-center">{{$user->description}}</p>
            </div>

            <div class="profile-subscriptions">
                <p class="uk-text-center">подписок: {{count($user->subscriptions)}}</p> 
                <p class="uk-text-center">подписчиков: {{count($user->subscribers)}}</p>
            </div>
        </div>
        
        <div class="uk-margin-large-top">
            <span uk-icon="more" class="uk-icon uk-icon-button uk-margin-small-top"></span>    
            <div class="uk-navbar-dropdown" uk-drop="mode: click; pos: bottom-left">
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li>
                        <a href="#user-update" uk-toggle>Редактировать профиль</a>
                        <div id="user-update" uk-modal>
                            <div class="uk-modal-dialog uk-modal-body">
                                <div class="uk-flex uk-flex-middle uk-flex-between">
                                    <form action="{{route('user.update', $user->id)}}" method="post" enctype="multipart/form-data">
                                        <fieldset class="uk-fieldset">
                                            @csrf
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="name">Имя</label>
                                                <input class="uk-input" type="text" name="name" value="{{$user->name}}">
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="description">Описание</label>
                                                <textarea class="uk-textarea" rows="5" name="description">{{$user->description}}</textarea>
                                            </div>
                                            <div class="uk-margin">
                                                <input type="file" aria-label="Custom controls" name="image">
                                            </div>
                                            <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                                            <button class="uk-button uk-button-primary" type="submit" name='board-create'>Создать</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#board-create" uk-toggle>Создать доску</a>
                        <div id="board-create" uk-modal>
                            <div class="uk-modal-dialog uk-modal-body">
                                <div class="uk-flex uk-flex-middle uk-flex-between">
                                    <form action="{{route('board.store')}}" method="post">
                                        <fieldset class="uk-fieldset">
                                            @csrf
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="name">Имя доски</label>
                                                <input class="uk-input" type="text" name="name" value="{{$user}}">
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="description">Описание доски</label>
                                                <textarea class="uk-textarea" rows="5" name="description"></textarea>
                                            </div>
                                            <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                                            <button class="uk-button uk-button-primary" type="submit" name='board-create'>Создать</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="">Что-то еще</a>
                    </li>
                </ul>
            </div>
        </div>

        <div uk-grid class="uk-child-width-1-3@s uk-grid-match uk-margin-large-top" >
        @foreach ( $boards as $board )
            <a href="{{route('board.index', $board->id)}}">
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <h3 class="uk-card-title">{{$board->name}}</h3>
                    <p>{{$board->description}}</p>
                </div>
            </a>
        @endforeach
        </div>
    </div>
    

@endsection('content')