@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавить место обитания (для {{$character->name}})</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('items.index', $character->id) }}" title="Назад"> <i
                        class="fa fa-backward "></i> </a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>!!!!</strong> При отправке возникли ошибки.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('items.store', $character->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row row-cols-1">
            <div class="col">
                <div class="form-group">
                    <strong>Название:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Факел"
                           value="{{ old('name') }}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <strong>Описание:</strong>
                    <textarea class="form-control" style="height:3em" name="description"
                              placeholder="Текст" >{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="col text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
