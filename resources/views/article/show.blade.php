@extends('layouts.app')
@section('title', $article->name)
@section('content')
    <h1>{{$article->name}}</h1>
    <div>{{Str::limit($article->body, 200)}}</div>
@endsection