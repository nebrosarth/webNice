@extends('app')

@section('content')
    <div class="main">
        <div class="middle">
            <h1 class="ms-auto me-2">Предметы ({{$character->name}})
            </h1>
            @if (Auth::check())
                <li class="nav-item">
                    <a type="button" role="button" class="btn btn-primary"
                       href="{{ route('items.create', $character) }}">Добавить</a>
                </li>
            @else
                <li class="nav-item">
                    <a type="button" role="button" class="btn btn-primary disabled">Добавить</a>
                </li>
            @endif
            <div class="objects">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    @foreach($items as $i)
                        <div class="col">
                            <div class="card{{(Auth::check()) ?
    (Auth::user()->friendsWith($i->user()->first())) ? " bg-warning" : " " : " "
    }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$i->name}}</h5>
                                    <p class="card-text">{{$i->description}}.</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <hr>
        <footer>
            <h3>Курочкин Владислав Юрьевич</h3>
            <div class="icons">
                <a href="https://store.steampowered.com/">
                    <img alt="steam" class="icon"
                         src="https://wmpics.pics/di-99E6.png">
                </a>
                <a href="https://instagram.com">
                    <img alt="instagram" class="icon"
                         src="https://img.icons8.com/windows/452/instagram-new.png">
                </a>
                <a href="https://facebook.com">
                    <img alt="facebook" class="icon"
                         src="http://simpleicon.com/wp-content/uploads/facebook-2.png">
                </a>
            </div>

        </footer>
    </div>
@endsection
