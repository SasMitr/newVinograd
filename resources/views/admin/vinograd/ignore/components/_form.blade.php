{!! Form::open(['route' => ['ignores.update', $item->id], 'method' => 'patch']) !!}
<div class="form-group">
    <label for="name">Тулефон</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone', $item->phone)}}">
</div>
<div class="form-group">
    <label for="slug">Email</label>
    <input type="text" class="form-control" id="email" name="email" value="{{old('email', $item->email)}}">
</div>
<div class="form-group">
    <label for="text">Примечание</label>
    <textarea name="note" id="content" class="form-control">{{old('note', $item->note)}}</textarea>
</div>
<div class="box-footer">
    <button class="btn btn-primary">Сохранить</button>
</div>
{!! Form::close() !!}
