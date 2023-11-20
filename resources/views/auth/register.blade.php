@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
@endsection

@section('content')
<div class="">
  <div class="container">
    <div class="login-page">
      <div class="logo">
        @if ($setting)
          <a href="{{url('/')}}" title="{{$setting->welcome_txt}}"><img src="{{asset('/images/logo/background.png')}}" class="img-responsive login-logo" alt="{{$setting->welcome_txt}}"></a>
        @endif
      </div>
      <h3 class="user-register-heading text-center">Registre</h3>
      <form class="form login-form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', 'Nom') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Entrez votre nom']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          {!! Form::label('email', 'Email') !!}
          {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'eg: foo@bar.com']) !!}
          <small class="text-danger">{{ $errors->first('email') }}</small>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          {!! Form::label('password', 'Mot de passe') !!}
          {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'placeholder'=>'Entrez le mot de passe']) !!}
          <small class="text-danger" style="color: red; background-color: #FFF;">{{ $errors->first('password') }}</small>
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          {!! Form::label('password_confirmation', 'Confirm password') !!}
          {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'placeholder'=>'Confirmez le mot de passe']) !!}
          <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
        </div>
        <div class="mr-t-20">
          <button type="submit" class="btn btn-wave">{{__('message.Create Account')}}</button>
          <a href="{{url('/login')}}" class="text-center " title="Already Have Account">{{__('message.Already Have Account ?')}}</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
