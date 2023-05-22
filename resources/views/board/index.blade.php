@extends('layouts.app')
@section('content')
    <div class="uk-flex uk-flex-middle uk-flex-center uk-flex-column">
        <h3>{{$board->name}}</h3>

        <p class="uk-margin-small-top  text-description">{{$board->description}}</p>

        <div>
            <span uk-icon="more" class="uk-icon uk-icon-button uk-margin-small-top"></span>
            <div uk-dropdown uk-drop="mode: click; pos: top-left">
                <ul class="uk-nav uk-dropdown-nav">
                    <li>
                        <a href="#board-delete" uk-toggle>Удалить</a>
                        <div id="board-delete" uk-modal>
                            <div class="uk-modal-dialog uk-modal-body">
                                <h2 class="uk-modal-title">Уверены, что хотите удалить доску {{$board->name}} ?</h2>
                                <div class="uk-flex uk-flex-middle uk-flex-between">
                                    <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                                    <form action="{{route('board.destroy', $board->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="uk-button uk-button-primary" type="submit" name='board-delete'>Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li>
                        <a href="#board-edit" uk-toggle>Редактировать</a>
                        <div id="board-edit" uk-modal>
                            <div class="uk-modal-dialog uk-modal-body">
                                <div class="uk-flex uk-flex-middle uk-flex-between">
                                    <form action="{{route('board.update', $board->id)}}" method="post">
                                        <fieldset class="uk-fieldset">
                                            @csrf
                                            @method('patch')
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="name">Имя доски</label>
                                                <input class="uk-input" type="text" name="name" value="{{$board->name}}">
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="description">Описание доски</label>
                                                <textarea class="uk-textarea" rows="5" name="description">{{$board->description}}</textarea>
                                            </div>
                                            <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                                            <button class="uk-button uk-button-primary" type="submit" name='board-edit'>Сохранить</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="#image-create" uk-toggle>Создать изображение</a>
                        <div id="image-create" uk-modal>
                            <div class="uk-modal-dialog uk-modal-body">
                                <div class="uk-flex uk-flex-middle uk-flex-between">
                                    <form action="{{route('image.store')}}" method="post" enctype="multipart/form-data">
                                        <fieldset class="uk-fieldset">
                                            @csrf
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="name">Имя изображения</label>
                                                <input class="uk-input" type="text" name="name">
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="description">Описание изображения</label>
                                                <textarea class="uk-textarea" rows="5" name="description"></textarea>
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="form-stacked-select">Доска</label>
                                                <div class="uk-form-controls">
                                                    <select class="uk-select" name="board_id">
                                                        @foreach ( Auth::user()->boards as $selectBoard)
                                                            <option value="{{$selectBoard->id}}" @if ($selectBoard->id == $board->id) selected @endif> 
                                                                {{$selectBoard->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <input type="file" aria-label="Custom controls" name="image">
                                            </div>
                                            <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                                            <button class="uk-button uk-button-primary" type="submit" name='image-create'>Сохранить</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="uk-margin-large-top">
            <p>{{count($board->images)}} изображений</p>
        </div>
    
        <div class="width-100 uk-flex uk-flex-column uk-flex-middle">
            <ul uk-tab class="uk-margin-large-top max-width-300">
                <li class><a href="">Созданные</a></li>
                <li class><a>Сохраненные</a></li>
            </ul>

            <ul class="uk-switcher uk-margin-top uk-width-1-1">
                <li>
                    <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-small " uk-grid="masonry: true">  
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
                </li>
                <li>
                    <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-small uk-width-1-1" uk-grid="masonry: true"> 
                        @foreach ($board->images as $image)
                            @if ($image->user->id != Auth::user()->id)
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