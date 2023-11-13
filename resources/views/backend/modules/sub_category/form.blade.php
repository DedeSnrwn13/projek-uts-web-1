{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, [
    'id' => 'name',
    'class' => 'form-control',
    'placeholder' => 'Enter sub category name',
]) !!}
{!! Form::label('slug', 'Slug', ['class' => 'mt-2']) !!}
{!! Form::text('slug', null, [
    'id' => 'slug',
    'class' => 'form-control',
    'placeholder' => 'Enter sub category slug',
]) !!}
{!! Form::label('category_id', 'Select Category', ['class' => 'mt-2']) !!}
{!! Form::select('category_id', $categories, null, ['id' => 'category_id', 'class' => 'form-select', 'placeholder' => 'Select category']) !!}
{!! Form::label('order_by', 'Sub category Serial', ['class' => 'mt-2']) !!}
{!! Form::number('order_by', null, [
    'id' => 'order_by',
    'class' => 'form-control',
    'placeholder' => 'Enter sub category serial',
]) !!}
{!! Form::label('status', 'Sub category Status', ['class' => 'mt-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'id' => 'status',
    'class' => 'form-select',
    'placeholder' => 'Select sub category status',
]) !!}
