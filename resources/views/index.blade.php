@extends('layouts.app')
@section('title', 'Электронный каталог')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			@foreach ($books as $book)
				<div class="card my-2" style="width: 100%;">
				  <div class="card-body">
				    <h5 class="card-title">{{$book->title}}</h5>
				    <h6 class="card-subtitle mb-2 text-muted">{{$book->author}} / {{$book->co_author}}</h6>
				    <p class="card-text">{{$book->description}}</p>
				    <a href="#" class="card-link">Удалить</a>
				    <a href="#" class="card-link">Редактировать</a>
				  </div>
				</div>
			@endforeach
        </div>
    </div>
</div>
@endsection