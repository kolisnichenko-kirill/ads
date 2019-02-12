@extends('app')

@section('content')

<div class="col-md-12">

    <div class="col-md-8">
        
        @foreach($ads as $ad)
            <div class="ad">

                <div class="title">
                    <a href="{{ route('show', ['id' => $ad->id]) }}">{{ $ad->title }}</a>
                </div>
                
                <div class="description">
                    {{ $ad->description }}
                </div>
                
                <div class="info">
                    {{ $ad->author_name }}, {{ $ad->created_at }}

                    <br>

                    @if (Auth::check() && Auth::user()->username == $ad->author_name)
                        <a href="{{ route('edit', ['id' => $ad->id]) }}">Edit</a>
                        <a href="{{ route('delete', ['id' => $ad->id]) }}">Delete</a>
                    @endif
                    
                </div>
                
            </div>
        @endforeach

        <div class="paginator">
            {{ $ads->links() }}
        </div>

    </div>

    <div class="col-md-4 right-menu">
    @guest
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
        
    @else
        <div class="greeting">
            Hello, {{ Auth::user()->username }}!
        </div>
        
        <div>
            <a href="{{ route('showCreateForm') }}">{{ __('Create Ad') }}</a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">
                {{ __('Logout') }}
            </button>
        </form>

    @endguest


    </div>
</div>
    
@endsection