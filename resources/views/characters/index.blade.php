@extends('app')

@section('content')
    <div class="main">
        <div class="middle">
            <h1>Персонажи Don't Starve Together
                @if (! is_null($user))
                    @if ($feed)
                        (для друзей пользователя {{$user->name}})
                    @else
                        (для пользователя {{$user->name}})
                    @endif
                @endif</h1>
            @if (Auth::check())
                <li class="nav-item">
                    <a type="button" role="button" class="btn btn-primary" href="/characters/create">Добавить</a>
                </li>
            @else
                <li class="nav-item">
                    <a type="button" role="button" class="btn btn-primary disabled">Добавить</a>
                </li>
            @endif
            <div class="objects">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    @foreach($characters as $c)
                        @if (!$c->trashed() || (Auth::user()->is_admin ?? null))
                        <div class="col">
                            <div class="card" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                 data-bs-num={{$c->id}}>
                                <h4 class="label">{{$c->name}}</h4>
                                <div class="photo-block">
                                    <img alt="logo"
                                         class="card-img-top img-fluid"
                                         src="{{$c->image_url}}">
                                    <h4 class="card-title">{{$c->name2}}</h4>
                                    <div class="card-text">{{$c->description}}</div>
                                </div>
                                @if(Auth::user()->is_admin ?? null)
                                    <div class="flex">
                                        <form action="{{route('characters.restore', $c->id)}}" method="post">
                                            @csrf
                                            <input type="text" hidden name="return_url" value="{{Request::url()}}">
                                            <input class="btn btn-success m-2" type="submit" name="restore"
                                                   value="Восстановить"/>
                                        </form>
                                        <form action="{{route('characters.purge', $c->id)}}" method="post">
                                            @csrf
                                            <input type="text" hidden name="return_url" value="{{Request::url()}}">
                                            <input class="btn btn-danger m-2" type="submit" name="purge"
                                                   value="Удалить"/>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
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
    <script>
        currentModel = 1;
        modalText = ["Уилсон (Wilson) — бесстрашный учёный-аристократ, пойманный демоном и перенесён в таинственный дикий мир, в котором он должен выжить и, самое главное, не голодать. Уилсон отращивает бороду, которая защищает его от холода и при сбривании даёт волосы. Его голос — труба с сурдиной.",
            "Уиллоу (Willow) — пироманка. Не получает урона от огня и повышает рассудок, когда находится рядом с ним. С самого начала игры носит зажигалку. Её голос — флейта.",
            "Вольфганг (Wolfgang) — силач. При достижении сытости более 225 единиц становится больше и сильнее. А достигнув сытости 100 становится слабым и худым. Тем не менее, он пуглив, поэтому темнота и монстры быстрее снижают его рассудок. Его голос — туба.",
            "Венди (Wendy) — у Венди есть особенный цветок, с помощью которого она может призвать свою призрачную сестру Абигейл. Призрак будет помогать довольно слабой Венди в бою. У Венди крепкие нервы, поэтому темнота и монстры меньше снижают ее рассудок. Голос Венди — альтовая флейта.",
            "WX-78 — может съесть несвежие и испорченные продукты без вреда здоровью и штрафа к сытости (но получает штрафы от гнили). Может есть шестерёнки для повышения характеристик. Получает урон под дождём и искрится. Если в него ударит молния (в том числе от Посоха телелокации), он мгновенно восстановит здоровье и ускорится, но потеряет часть рассудка. Его голос похож на синтезатор."]

        let ids = [
            @foreach($characters as $c)
                {{$c->id}},
            @endforeach
        ]
        modalCount = ids.length
        var exampleModal = document.getElementById('exampleModal')

        function showInfoq(i) {
            currentModel = i;
            var modalParagraph = exampleModal.querySelector('.modal-body p')
            text = modalText[i];
            modalParagraph.innerHTML = text
        }

        exampleModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var num = button.getAttribute('data-bs-num')
            currentModel = num
            showInfo(num)
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.


        })

        function showInfo(i) {
            var modalParagraph = exampleModal.querySelector('.modal-content');
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    modalParagraph.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", `/characters/${i}`, true);
            xhttp.send();
            currentModal = i;
        }

        exampleModal.addEventListener("keydown", event => {
            if (event.isComposing || event.key === "ArrowLeft") {
                showInfo(currentModel > 1 ? currentModel - 1 : 1)
            } else if (event.isComposing || event.key === "ArrowRight") {
                showInfo(currentModel < modalCount ? Number(currentModel) + 1 : modalCount)
            }
        })
    </script>
@endsection
