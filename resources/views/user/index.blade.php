@extends('layouts.app')
@section('content')
    <div class="uk-section uk-section-muted uk-section-xsmall uk-flex uk-flex-middle uk-flex-right uk-margin-bottom">
        <a uk-icon="more" class="uk-icon uk-margin-small-left">
            <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle cx="3" cy="10" r="2"/><circle cx="10" cy="10" r="2"/><circle cx="17" cy="10" r="2"/></svg>
        </a>    
        <div class="uk-navbar-dropdown" uk-drop="mode: click; pos: bottom-left">
            <ul class="uk-nav uk-navbar-dropdown-nav">
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
                                            <input class="uk-input" type="text" name="name" >
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
    <div uk-grid class="uk-child-width-1-3@s uk-grid-match" >
        @foreach ( $boards as $board )
            <a href="{{route('board.index', $board->id)}}">
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <h3 class="uk-card-title">{{$board->name}}</h3>
                    <p>{{$board->description}}</p>
                </div>
            </a>
        @endforeach
    </div>

@endsection('content')