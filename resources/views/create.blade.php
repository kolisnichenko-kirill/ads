@extends('app')

@section('content')

    <form method="POST" action="{{ route('create') }}">
        
        @include('form')

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
            </div>
        </div>
    </form>

@endsection