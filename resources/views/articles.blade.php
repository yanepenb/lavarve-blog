@extends('layouts.app')

@section('header', 'Статьи')

@section('content')
    @foreach ($articles as $article)
        <p>
            # {{ $article->id }}
            Name: {{ $article->name }}
            <br>
            Body: {{ $article->body }}
        <p>
    @endforeach
@endsection