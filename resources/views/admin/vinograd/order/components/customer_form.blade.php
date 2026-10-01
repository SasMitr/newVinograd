<div class="card card-outline card-success">
    <div class="card-header">
        <h3 class="card-title text-dark">Заказчик</h3>
    </div>
    <div class="card-body text-dark">
        <form action="{{route('orders.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="customer[name]">Имя <span class="text-danger">*</span></label>
                <input type="text" name="customer[name]"
                       class="form-control{{ $errors->first('customer.name') ? ' is-invalid' : '' }}"
                       value="{{ old('customer.name') }}" id="customer[name]">
                <div class="invalid-feedback" id="invalid-customer[name]">
                    {{ $errors->first('customer.name') ? $errors->first('customer.name') : '' }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer[email]">Email<span class="text-danger">*</span></label>
                        <input name="customer[email]" placeholder="" type="email"
                               class="form-control{{ $errors->first('customer.email') ? ' is-invalid' : '' }}"
                               value="{{ old('customer.email') }}" id="customer[email]">
                        <div class="invalid-feedback" id="invalid-customer[email]">
                            {{ $errors->first('customer.email') ? $errors->first('customer.email') : '' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer[phone]">Либо Телефон <span class="text-danger">*</span></label>
                        <input type="text" name="customer[phone]"
                               class="form-control{{ $errors->first('customer.phone') ? ' is-invalid' : '' }}"
                               value="{{ old('customer.phone') }}" id="customer[phone]">
                        <div class="invalid-feedback" id="invalid-customer[phone]">
                            {{ $errors->first('customer.phone') ? $errors->first('customer.phone') : '' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-info">Сохранить</button>
            </div>
        </form>
    </div>
</div>





