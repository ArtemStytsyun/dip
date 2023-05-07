@extends('layouts.app')
@section('content')
    <div class="uk-section uk-section-muted uk-section-xsmall uk-flex uk-flex-middle uk-flex-center">
        {{$board->name}}
        <span uk-icon="cog" class="uk-icon uk-margin-small-left">
            <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle fill="none" stroke="#000" cx="9.997" cy="10" r="3.31"/><path fill="none" stroke="#000" d="M18.488,12.285 L16.205,16.237 C15.322,15.496 14.185,15.281 13.303,15.791 C12.428,16.289 12.047,17.373 12.246,18.5 L7.735,18.5 C7.938,17.374 7.553,16.299 6.684,15.791 C5.801,15.27 4.655,15.492 3.773,16.237 L1.5,12.285 C2.573,11.871 3.317,10.999 3.317,9.991 C3.305,8.98 2.573,8.121 1.5,7.716 L3.765,3.784 C4.645,4.516 5.794,4.738 6.687,4.232 C7.555,3.722 7.939,2.637 7.735,1.5 L12.263,1.5 C12.072,2.637 12.441,3.71 13.314,4.22 C14.206,4.73 15.343,4.516 16.225,3.794 L18.487,7.714 C17.404,8.117 16.661,8.988 16.67,10.009 C16.672,11.018 17.415,11.88 18.488,12.285 L18.488,12.285 Z"/></svg>
        </span>
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
    @foreach ($board->images as $image)
        <a href="{{route('image.index', $image->id)}}">{{$image->name}}Картинка</a>
    @endforeach
@endsection('content')