@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавить нового персонажа</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('characters.index') }}" title="Go back">Назад</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('characters.store') }}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Имя персонажа" value="{{old('name')}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Описание:</strong>
                    <textarea class="form-control" style="height:50px" name="description"
                              placeholder="Краткое описание" value="{{old('description')}}"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя2:</strong>
                    <input type="text" name="name2" class="form-control" placeholder="Качества персонажа" value="{{old('name2')}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Описание2:</strong>
                    <textarea type="text" name="description2" class="form-control" placeholder="Подробное описание" value="{{old('description2')}}"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Аватар:</strong>
                    <textarea type="text" name="image_url" class="form-control" placeholder="Аватар персонажа" value="{{old('image_url')}}"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дата:</strong>
                    <textarea type="text" name="date1" class="form-control" placeholder="Дата" value="{{old('date1')}}"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>

    </form>
@endsection
