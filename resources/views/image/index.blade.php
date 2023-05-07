@extends('layouts.app')
@section('content')
    <div>
        <div>
            <img src="{{asset('/storage/' . $image->path)}}" alt="">
            <div>
                <div>
                    <a uk-icon="more" class="uk-icon uk-margin-small-left">
                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle cx="3" cy="10" r="2"/><circle cx="10" cy="10" r="2"/><circle cx="17" cy="10" r="2"/></svg>
                    </a>    
                    <div class="uk-navbar-dropdown" uk-drop="mode: click; pos: bottom-left">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li>
                                <a href="#image-edit" uk-toggle>Редактировать изображение</a>
                                <div id="image-edit" uk-modal>
                                    <div class="uk-modal-dialog uk-modal-body">
                                        <div class="uk-flex uk-flex-middle uk-flex-between">
                                            <form action="{{route('image.update', $image->id)}}" method="post">
                                                <fieldset class="uk-fieldset">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="uk-margin">
                                                        <label class="uk-form-label" for="name">Имя изображения</label>
                                                        <input class="uk-input" type="text" name="name" value="{{$image->name}}">
                                                    </div>
                                                    <div class="uk-margin">
                                                        <label class="uk-form-label" for="description">Описание изображения</label>
                                                        <textarea class="uk-textarea" rows="5" name="description">{{$image->description}}</textarea>
                                                    </div>
                                                    <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                                                    <button class="uk-button uk-button-primary" type="submit" name='image-edit'>Сохранить</button>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <a href="#image-delete" uk-toggle>Удалить</a>
                                <div id="image-delete" uk-modal>
                                    <div class="uk-modal-dialog uk-modal-body">
                                        <h2 class="uk-modal-title">Уверены, что хотите удалить изображения {{$image->name}} ?</h2>
                                        <div class="uk-flex uk-flex-middle uk-flex-between">
                                            <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                                            <form action="{{route('image.destroy', $image->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="uk-button uk-button-primary" type="submit" name='image-delete'>Удалить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>    
                <div>
                    Описание
                    {{-- {{$image->path}} --}}
                </div>
                <div>
                    Комментарии
                    @foreach ($comments as $commnet )
                        <div>{{$commnet}}</div>
                    @endforeach
                </div>
                <div>
                    <form action="{{route('image.comment.store', $image)}}" method="post">
                        @csrf
                        <div class="uk-margin">
                            <label class="uk-form-label" for="description">Комментарий</label>
                            <textarea name="text" id="" cols="30" rows="1">

                            </textarea>
                        </div>
                        <button class="uk-button uk-button-primary" type="submit" name='comment-create'>Отправить</button>
                    </form>
                </div>
            </div>    
            </div>    
        </div>
        <div uk-grid class="uk-child-width-1-3@s uk-grid-match" >
            {{count($likedUsers) }}
            <div>
                <form action="{{route('image.like.index', $image)}}" method="post">
                    @csrf
                    <button class="uk-button uk-button-primary" type="submit" name='like-create'>Лайк</button>
                </form>
            </div>
        </div>
        <div>
            Похожие
        </div>
        
    </div>
@endSection('content')