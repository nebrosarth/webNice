<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Описание</h5>
    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
</div>
<div class="modal-body">
    <p>{{$character->description2}}</p>
</div>

<div class="modal-footer">
    <a class="btn btn-info" href="{{route('items.index', $character->id)}}">Предметы</a>
    @if(Gate::allows('modify-object', $character))
    <a type="button" class="btn btn-primary" role="button" href="characters/{{$character->id}}/edit">Редактировать</a>
    <form action="/characters/{{$character->id}}" method="post">
        @method('DELETE')
        @csrf
        <button class="btn btn-primary" role="button" >Удалить</button>
    </form>
    @endif
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
</div>

