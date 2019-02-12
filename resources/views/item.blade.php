@extends('app')

@section('content')

    <div class="ad">
        <div class="title">
            {{ $item->title }}
        </div>
        
        <div class="description">
            {{ $item->description }}
        </div>
        
        <div class="info">
            {{ $item->author_name }}, {{ $item->created_at }}

            <br>
            
            @if (Auth::check() && Auth::user()->username == $item->author_name)
                <a href="{{ route('edit', ['id' => $ad->id]) }}">Edit</a>
                <a href="{{ route('delete', ['id' => $ad->id]) }}">Delete</a>
            @endif
        </div>
    </div>

@endsection