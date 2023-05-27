@extends('layouts.app')
@section('content')
<div class="uk-container">
    <div class="uk-flex uk-flex-center">
        <div class="uk-card uk-card-default uk-width-1-2@s uk-width-1-3@m">
            <div class="uk-card-header">
                Авторизация
            </div>

            <div class="uk-card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="uk-margin-small uk-flex uk-flex-column">
                        <label for="email" >{{ __('Почта') }}</label>
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: mail"></span>
                            <input id="email" type="email" class="uk-input uk-width-1-1 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div> 
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="uk-margin-small uk-flex uk-flex-column">
                        <label for="password">Пароль</label>
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            <input id="password" type="password" class="uk-input uk-width-1-1 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div> 
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="uk-margin">
                        <div class="uk-inline">
                            <div class="form-check">
                                <input class="uk-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Запомнить меня') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <button type="submit" class="uk-button uk-button-default">
                            Войти
                        </button>
                    </div>
                </form>
            </div>
            {{-- <div class="uk-card-footer">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Забыли свой пароль?
                    </a>
                @endif
            </div> --}}
        </div>
    </div>
</div>
@endsection
