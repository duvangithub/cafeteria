@extends('layouts.app')

@section('content')

<div class="row">
</div>

<div class="container">

    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width ">
        <li class="tab #efebe9 brown lighten-5 "><a class=" active brown-text" href="#test1">Inicio de sesion</a></li>
      </ul>
    </div>

              
                 <div class="card darken-1 ">
                    <div class="card-content #efebe9 brown lighten-5">
                         <div id="test1">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="s12">
                        @csrf

                        <div class="row">
                           <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                             @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <label for="email">Correo electronico</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                            <i class="material-icons prefix">create</i>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                             @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                             <label for="password">Contraseña</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col m6 offset m4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recuerdame') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn #66bb6a green lighten-1">
                                    {{ __('Entrar') }}
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            
     
    
</div>

@endsection
