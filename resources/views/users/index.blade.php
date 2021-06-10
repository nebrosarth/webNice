@extends('app')

@section('content')
    <div class="main">
        <div class="container">
            @if (Auth::check())
                <li class="nav-item">
                    <a>{{Auth::user()->token}}</a>
                </li>
            @endif
            <div class="list-group">
                @foreach($users as $u)
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('users.characters', $u->name) }}">
                        <div class="row row-cols-1 row-cols-sm-3">
                            <div>
                                {{$u->name}}
                            </div>
                            @if(Auth::check())
                                @if (! Auth::user()->friendsWith($u))
                                    <form action="{{route('users.befriend', $u->name)}}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-success" value="Дружить">
                                    </form>
                                @else
                                    <form action="{{route('users.unfriend', $u->name)}}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-danger" value="Перестать дружить">
                                    </form>
                                @endif
                            @endif
                            <div class="col">
                                <form action="{{route('users.feed', $u->name)}}" method="Get">
                                    <input type="submit" class="btn btn-info" value="Лента">
                                </form>
                            </div>
                        </div>
                    </a>
                @endforeach
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
