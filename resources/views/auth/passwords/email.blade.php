@extends('layouts.app')
@section('content')
<div class="uk-container">
    <div class="uk-flex uk-flex-center">
        <div class="uk-card uk-card-default uk-width-1-2@s uk-width-1-3@m">
            <div class="uk-card-header">
                Восстановление пароля
            </div>

            <div class="uk-card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="uk-margin-small uk-flex uk-flex-column">
                            <label for="email" class="">Почта</label>

                            <div class="uk-inline">
                                <input id="email" type="email" class="uk-input uk-width-1-1 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-margin">
                            <button type="submit" class="uk-button uk-button-default">
                                Отправить ссылку
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
