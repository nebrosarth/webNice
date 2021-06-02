@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактировать персонажа</h2>
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

    <form action="{{ route('characters.update', $character->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" value="{{ $character->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Описание:</strong>
                    <textarea class="form-control" style="height:50px" name="description"
                              placeholder="Introduction">{{ $character->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя2:</strong>
                    <input type="text" name="name2" class="form-control" placeholder="{{ $character->name2 }}"
                           value="{{ $character->name2 }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Описание2:</strong>
                    <textarea class="form-control" style="height:100px" name="description2"
                              placeholder="Introduction">{{ $character->description2 }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Аватар:</strong>
                    <textarea class="form-control" style="height:100px" name="image_url"
                              placeholder="Introduction">{{ $character->image_url }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дата:</strong>
                    <textarea class="form-control" style="height:100px" name="date1"
                              placeholder="Introduction">{{ $character->date1 }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>

    </form>
@endsection
