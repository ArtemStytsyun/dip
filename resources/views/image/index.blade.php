{{-- @extends('layouts.app')
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
                  {{$image->path}} 
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
@endSection('content') --}}

















 @extends('layouts.app')
@section('content')
    <div>
        <div class="image-section">
            <div class="image-block">
                <img src="{{asset('/storage/' . $image->path)}}" alt="">
            </div>
            <div class="image-content">
                <div class="image-content-actions">
                    @guest
                    @else
                        <div class="uk-margin-small">
                            <a uk-icon="more" class="uk-icon uk-icon-button">
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
                                                <h2 class="uk-modal-title">Уверены, что хотите удалить изображение {{$image->name}} ?</h2>
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
                        
                        <div class="image-form-action-block" uk-margin>
                            <form class="image-form-save" action="{{route('image.save', $image->id)}}" method="POST" >
                                @csrf
                                <div class="uk-form-controls image-input-select">
                                    <select class="uk-select" name="board_id">
                                        @foreach ( Auth::user()->boards as $selectBoard)
                                            <option value="{{$selectBoard->id}}" 
                                                @if($image->boards->where('user_id', Auth::user()->id)->first() != null);
                                                    @if ($selectBoard->id == $image->boards->where('user_id', Auth::user()->id)->first()->id) 
                                                        selected 
                                                    @endif
                                                @endif> 
                                                {{$selectBoard->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="uk-button uk-button-default uk-button-small uk-margin-small-left" type="submit" name='image-save'>Сохранить</button>
                            </form>
                            
                            <form class="image-form-like uk-margin-small-left uk-flex uk-flex-middle" action="{{route('image.like.index', $image)}}" method="post">
                                @csrf
                                <p>{{count($image->likedUsers)}}</p>
                                <button class="uk-button uk-button-default uk-button-small uk-margin-small-left" type="submit" name='like-create'>Лайк</button>
                                {{-- <div class="button-icon">
                                     <span uk-icon="heart" class="uk-icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke="#000" stroke-width="1.03" d="M10,4 C10,4 8.1,2 5.74,2 C3.38,2 1,3.55 1,6.73 C1,8.84 2.67,10.44 2.67,10.44 L10,18 L17.33,10.44 C17.33,10.44 19,8.84 19,6.73 C19,3.55 16.62,2 14.26,2 C11.9,2 10,4 10,4 L10,4 Z"/></svg>
                                    </span>  
                                </div>  --}}
                            </form>
                        </div>
                

                    @endguest

                </div>
                <hr>
                <div class="image-content-info">
                    <div class="image-name">
                        <h2>{{$image->name}}</h2>   
                    </div>
                    <div class="image-description">
                        <p>{{$image->description}}</p>
                    </div>
                    <a href="{{route('user', $image->user->id)}}" class="image-author">
                        <div class="image-author-info">
                            <h2>{{$image->user->picture}}</h2>
                            <p>{{$image->user->name}}</p>
                        </div>
                    </a>
                </div>
                <hr>
                <div class="image-comment-section">
                    <h2>Комментарии</h2>
                    <div class="image-comment-block">
                        <ul class="image-comment-list uk-list">
                            @foreach ($comments as $comment)
                            <li class="image-comment-item uk-margin-top">
                                <div class="image-comment-info">
                                    <a href="{{route('user', $comment->user->id)}}">
                                        <div class="user-default-icon image-comment-user-picture uk-margin-small-right">{{$comment->user->picture}}</div>
                                        <div class="image-comment-user-name uk-margin-right uk-flex uk-flex-middle uk-text-center">{{$comment->user->name}}</div>
                                    </a>
                                    <div class="image-comment-dataTime uk-flex uk-flex-middle uk-text-center">{{$comment->created_at}}</div>
                                </div>
                                
                                <div class="image-comment-text"><p>{{$comment->text}}</p></div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    
                </div>
                <hr>
                <form class="image-comment-form uk-margin-small-top uk-margin-small-bottom" action="{{route('image.comment.store', $image)}}" method="post" >
                    @csrf
                    <textarea class="image-comment-input-text" name="text" id="">

                    </textarea>
                    <button class="comment-send-button" type="submit" name='comment-create'>
                        Отправить
                    </button>
                </form>
            </div>
        </div>
        <div class="uk-flex uk-flex-column uk-flex-middle uk-margin-small-top">
            <h3>Похожие изображения</h3>
            <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid-small uk-margin-small-top" uk-grid="masonry: true"> 
                @foreach ($images as $image)
                    <a href="{{route('image.index', $image->id)}}">
                        <img class="uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle image-card" src="{{asset('/storage/' . $image->path)}}" alt="">
                        <p>{{$image->name}}</p>
                        <p>{{$image->user->name}}</p>
                    </a>
                @endforeach
            </div>
        </div>
        
    </div>
@endSection('content') 