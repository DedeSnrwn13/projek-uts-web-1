@extends('backend.layouts.master')

@section('title', 'Category')

@section('subtitle', 'Details')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Category Details</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $category->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                                </tr>
                                <tr>
                                    <th>Order By</th>
                                    <td>{{ $category->order_by }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $category->created_at->toDayDateTimeString() }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $category->created_at != $category->updated_at ? $category->updated_at->toDayDateTimeString() : 'No Updated' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="{{ route('category.index') }}"><button class="btn btn-success btn-sm">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
