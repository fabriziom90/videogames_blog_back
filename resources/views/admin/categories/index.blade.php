@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Tutte le categorie</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.categories.create') }}" class="primary-button">Aggiungi
                            categoria</a>
                    </div>
                </div>
            </div>
            @if (\Session::has('message'))
                <div class="alert alert-success-primary-blue">
                    <ul class="list-unstyled">
                        <li>{!! \Session::get('message') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="col-12">
                <table class="table" id="table-categories">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Copertina</th>
                            <th>Nome</th>
                            <th>Slug</th>
                            <th>N° Posts</th>
                            <th>Strumenti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    @if ($category->cover_image != null)
                                        <img src="{{ asset('/storage/' . $category->cover_image) }}"
                                            alt="{{ $category->name }}" width="150">
                                    @else
                                        Immagine di copertina non impostato
                                    @endif
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ count($category->posts) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.categories.show', ['category' => $category->id]) }}"
                                            title="Visualizza categoria" class="primary-button-sm me-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                                            title="Modifica categoria" class="warning-button-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}"
                                            method="post"
                                            onsubmit="return confirm('Sei sicuro di voler cancellare questo post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-square btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> --}}
                                        <button class="btn-delete delete-button-sm" data-bs-toggle="modal"
                                            data-bs-target="#modal_category_delete" data-id="{{ $category->id }}"
                                            data-type="categories" data-title="{{ $category->title }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        {{-- <button class="btn btn-sm btn-square btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modal_post_delete-{{ $post->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button> --}}

                                        {{-- @include('admin.posts.partials.modal_delete') --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.categories.partials.modal_delete')
@endsection
