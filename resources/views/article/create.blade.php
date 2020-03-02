@extends('layouts.app')
@section('title', 'создать статью')
@section('content')
    {{ Form::model($article, ['url' => route('articles.store')]) }}
        @include('article.form')
        {{ Form::submit('Сохранить') }}
    {{ Form::close() }}
@endsection