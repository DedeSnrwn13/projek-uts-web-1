@extends('backend.layouts.master')

@section('title', 'Post')

@section('subtitle', 'List')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Post List</h4>
                        <a href="{{ route('post.create') }}"><button class="btn btn-success btn-sm">Add</button></a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('msg'))
                        <div class="alert alert-{{ session('cls') }}">
                            {!! session('msg') !!}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover post-table">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th class="align-middle">
                                        <p>Title</p>
                                        <hr>
                                        <p>Slug</p>
                                    </th>
                                    <th>
                                        <p>Category</p>
                                        <hr>
                                        <p>Sub Category</p>
                                    </th>
                                    <th>
                                        <p>Status</p>
                                        <hr>
                                        <p>Is Approved</p>
                                    </th>
                                    <th>Photo</th>
                                    <th>Tags</th>
                                    <th>
                                        <p>Created At</p>
                                        <hr>
                                        <p>Updated At</p>
                                        <hr>
                                        <p>Created By</p>
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <p>{{ $post->title }}</p>
                                            <hr>
                                            <p>{{ $post->slug }}</p>
                                        </td>
                                        <td>
                                            <p><a href="{{ route('category.show', $post->category->id) }}">{{ $post->category?->name }}</a></p>
                                            <hr>
                                            <p><a href="{{ route('sub-category.show', $post->sub_category->id) }}">{{ $post->sub_category?->name }}</a></p>
                                        </td>
                                        <td>
                                            <p>{{ $post->status == 1 ? 'Published' : 'Not Published' }}</p>
                                            <hr>
                                            <p>{{ $post->is_approved == 1 ? 'Approved' : 'Not Approved' }}</p>
                                        </td>
                                        <td>
                                            <img class="img-thumbnail post_image"
                                                data-src="{{ $post->photo }}"
                                                src="{{ $post->photo }}"
                                                alt="{{ $post->title }}">
                                        </td>
                                        <td>
                                            @php
                                                $classes = ['btn-success', 'btn-info', 'btn-danger', 'btn-warning', 'btn-dark'];
                                            @endphp
                                            @foreach ($post->tag as $tag)
                                                <a class="text-decoration-none" href="{{ route('tag.show', $tag->id) }}">
                                                    <button class="btn btn-sm {{ $classes[random_int(0, 4)] }} mb-1">{{ $tag->name }}</button>
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            <p>{{ $post->created_at->toDayDateTimeString() }}</p>
                                            <hr>
                                            <p>{{ $post->created_at != $post->updated_at ? $post->updated_at->toDayDateTimeString() : 'No Updated' }}
                                            </p>
                                            <hr>
                                            <p>{{ $post->user?->name }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('post.show', $post->id) }}"><button
                                                        class="btn btn-info btn-sm"><i
                                                            class="fa-solid fa-eye"></i></button></a>
                                                <a href="{{ route('post.edit', $post->id) }}"><button
                                                        class="btn btn-warning btn-sm mx-1"><i
                                                            class="fa-solid fa-edit"></i></button></a>
                                                {!! Form::open([
                                                    'method' => 'delete',
                                                    'route' => ['post.destroy', $post->id],
                                                    'id' => 'form_' . $post->id,
                                                ]) !!}
                                                {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                                    'type' => 'button',
                                                    'data-id' => $post->id,
                                                    'class' => 'delete btn btn-danger btn-sm',
                                                ]) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

            <!-- Button trigger modal -->
            <button id="image_show_button" type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#imageShow">
                Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="imageShow" tabindex="-1" aria-labelledby="imageShowLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="imageShowLabel">Blog Image</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img class="img-thumbnail" alt="Display Image" id="display_image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('msg'))
        @php
            $cls = session('cls') == 'danger' ? 'error' : session('cls');
        @endphp

        @push('js')
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "{{ $cls }}",
                    toast: true,
                    title: "{{ session('msg') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            </script>
        @endpush
    @endif

    @push('js')
        <script>
            $('.post_image').on('click', function() {
                let img = $(this).attr('data-src');
                $('#display_image').attr('src', img);
                $('#image_show_button').trigger('click');
            });

            $('.delete').on('click', function() {
                let id = $(this).attr('data-id');
                console.log(id);

                Swal.fire({
                    title: "Are you sure to delete?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#form_${id}`).submit();
                    }
                });
            });
        </script>
    @endpush
@endsection
