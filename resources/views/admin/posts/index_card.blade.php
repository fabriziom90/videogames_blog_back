@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2>All posts</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-sm primary-button">Add post</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="my-3">
                    <a href="{{ route('admin.posts.index', ['show_type' => 0]) }}" class="primary-button me-2">
                        <i class="fa-solid fa-table"></i>
                    </a>
                    <a href="{{ route('admin.posts.index', ['show_type' => 1]) }}" class="primary-button" disabled><i
                            class="fa-solid fa-table-columns"></i>
                    </a>
                </div>
            </div>
            @foreach ($posts as $post)
                <div class="col-12 col-md-3">
                    <div class="card my-3">
                        <img src="{{ $post->cover_image ? asset('/storage/' . $post->cover_image) : asset('/img/aaaabbbb.jpg') }}"
                            alt="" class="card-img-top">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>{{ $post->title }}</h4>
                                <p><strong>Categoria:</strong>{{ $post->category != null ? $post->category->name : 'Senza categoria' }}
                                </p>
                                <p>{{ Str::limit($post->content, 20, '...') }}</p>
                                <div class="d-flex">
                                    <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" title="Visualizza post"
                                        class="btn btn-sm btn-square btn-primary me-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" title="Modifica post"
                                        class="btn btn-sm btn-square btn-warning me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-square btn-danger btn-delete" data-bs-toggle="modal"
                                        data-bs-target="#modal_post_delete" data-id="{{ $post->id }}"
                                        data-title="{{ $post->title }}" data-type="posts">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('admin.posts.partials.modal_delete')
@endsection
