@extends('backend.layouts.master')

@section('title', 'Category')

@section('subtitle', 'List')

@section('content')
    <div class="row jusify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Category List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Order By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ $category->order_by }}</td>
                                        <td>{{ $category->created_at->toDayDateTimeString() }}</td>
                                        <td>{{ $category->created_at != $category->updated_at ? $category->updated_at->toDayDateTimeString() : 'No Updated' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('category.show', $category->id) }}"><button class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                                                <a href="{{ route('category.edit', $category->id) }}"><button class="btn btn-warning btn-sm mx-1"><i class="fa-solid fa-edit"></i></button></a>
                                                {!! Form::open() !!}
                                                {!! Form::button('<i class="fa-solid fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
