@extends('app')

@section('content')

    <form method="POST" action="{{ route('edit', ['id' => $ad->id]) }}">
        
        @include('form')

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </form>

@endsection