<div class="card card-outline card-success">
    <div class="card-header">
        <h3 class="card-title text-dark">Блокируем заказчика</h3>
    </div>
    <div class="card-body text-dark">
        <form action="{{route('ignores.blocked.store')}}" method="POST">
            @csrf
            <input type="hidden" name="ignor_id" value="{{isset($ignor_id) ? $ignor_id : ''}}">
        <div class="form-group">
            <label for="name">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone', $phone)}}">
        </div>
        <div class="form-group">
            <label for="slug">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email', $email)}}">
        </div>
        <div class="form-group">
            <label for="text">Примечание</label>
            <textarea name="note" id="content" class="form-control">{{old('note', $note)}}</textarea>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary">Сохранить</button>
        </div>
{{--        {!! Form::close() !!}--}}
        </form>
    </div>
</div>
