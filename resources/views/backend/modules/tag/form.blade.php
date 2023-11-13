{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, [
    'id' => 'name',
    'class' => 'form-control',
    'placeholder' => 'Enter tag name',
]) !!}
{!! Form::label('slug', 'Slug', ['class' => 'mt-2']) !!}
{!! Form::text('slug', null, [
    'id' => 'slug',
    'class' => 'form-control',
    'placeholder' => 'Enter tag slug',
]) !!}
{!! Form::label('order_by', 'Tag Serial', ['class' => 'mt-2']) !!}
{!! Form::number('order_by', null, [
    'id' => 'order_by',
    'class' => 'form-control',
    'placeholder' => 'Enter tag serial',
]) !!}
{!! Form::label('status', 'Tag Status', ['class' => 'mt-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'id' => 'status',
    'class' => 'form-select',
    'placeholder' => 'Select tag status',
]) !!}
