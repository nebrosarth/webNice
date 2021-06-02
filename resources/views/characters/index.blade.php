<!DOCTYPE html>
<html lang="ru">

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Персонажи Don't starve together</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
<div class="main">
    <ul class="nav bg-secondary nav-pills nav-fill">
        <li class="nav-item">
            <img class="img-fluid"
                 src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png">
        </li>
        <li class="nav-item">
            <h4 class="nav-link" href="#">Don't Starve Together fandom</h4>
        </li>
        <li class="nav-item">
            <a onclick="fNotImplError.show()" class="btn btn-primary" href="#">Загрузить</a>
        </li>

    </ul>
    <div class="middle">
        <h1>Персонажи Don't Starve Together</h1>
        <div class="objects">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                @foreach($characters as $c)
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

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="false">
        <div class="position-fixed top-0 end-0">
            <div class="toast-header">
                <div class="loadicon">
                    <img src="./settings_32px.png" class="rounded me-2" alt="...">
                </div>
                <strong class="me-auto">Bootstrap</strong>
                <small class="text-muted">11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body ">

                Hello, world! This is a toast messagssssssssssssssse.
            </div>
        </div>
    </div>
</div>
<script>
    currentModel = 0;
    modalText = ["Уилсон (Wilson) — бесстрашный учёный-аристократ, пойманный демоном и перенесён в таинственный дикий мир, в котором он должен выжить и, самое главное, не голодать. Уилсон отращивает бороду, которая защищает его от холода и при сбривании даёт волосы. Его голос — труба с сурдиной.",
        "Уиллоу (Willow) — пироманка. Не получает урона от огня и повышает рассудок, когда находится рядом с ним. С самого начала игры носит зажигалку. Её голос — флейта.",
        "Вольфганг (Wolfgang) — силач. При достижении сытости более 225 единиц становится больше и сильнее. А достигнув сытости 100 становится слабым и худым. Тем не менее, он пуглив, поэтому темнота и монстры быстрее снижают его рассудок. Его голос — туба.",
        "Венди (Wendy) — у Венди есть особенный цветок, с помощью которого она может призвать свою призрачную сестру Абигейл. Призрак будет помогать довольно слабой Венди в бою. У Венди крепкие нервы, поэтому темнота и монстры меньше снижают ее рассудок. Голос Венди — альтовая флейта.",
        "WX-78 — может съесть несвежие и испорченные продукты без вреда здоровью и штрафа к сытости (но получает штрафы от гнили). Может есть шестерёнки для повышения характеристик. Получает урон под дождём и искрится. Если в него ударит молния (в том числе от Посоха телелокации), он мгновенно восстановит здоровье и ускорится, но потеряет часть рассудка. Его голос похож на синтезатор."]
    modalCount = modalText.length
    let ids = [
        @foreach($characters as $c)
            {{$c->id}},
        @endforeach
    ]
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
        i = (i + modalCount) % modalCount;
        var modalParagraph = exampleModal.querySelector('.modal-content');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                modalParagraph.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", `characters/${i}`, true);
        xhttp.send();
        currentModal = i;
    }

    exampleModal.addEventListener("keydown", event => {
        if (event.isComposing || event.key === "ArrowLeft") {
            showInfo(currentModel > 0 ? currentModel - 1 : 0)
        } else if (event.isComposing || event.key === "ArrowRight") {
            showInfo(currentModel < modalCount - 1 ? Number(currentModel) + 1 : modalCount - 1)
        }
    })
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, {})
    });
    var fNotImplError = toastList[0];
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new Popover(popoverTriggerEl)
    });

    var popover = new bootstrap.Popover(document.querySelector('.popover-dismiss'), {
        trigger: 'focus'
    })
</script>
</body>
</html>
