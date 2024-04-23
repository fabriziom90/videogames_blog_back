@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Tutti i post</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.posts.create') }}" class="primary-button">Aggiungi videogame</a>
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
            @if (count($posts))
                <div class="col-12">
                    <div class="my-3">
                        <a href="{{ route('admin.posts.index', ['show_type' => 0]) }}" class="primary-button-sm me-2"
                            disabled>
                            <i class="fa-solid fa-table"></i>
                        </a>
                        <a href="{{ route('admin.posts.index', ['show_type' => 1]) }}" class="primary-button-sm"><i
                                class="fa-solid fa-table-columns"></i>
                        </a>
                    </div>
                    @role('admin')
                        <table class="table" id="table-posts-admin">
                        @else
                            <table class="table" id="table-posts-user">
                            @endrole

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    @role('admin')
                                        <th>Utente</th>
                                    @endrole
                                    <th>Titolo</th>
                                    <th>Categoria</th>
                                    <th>Slug</th>
                                    <th>Testo</th>
                                    <th>Stato</th>
                                    <th>Strumenti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        @role('admin')
                                            <td>{{ $post->user->email }}</td>
                                        @endrole
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->category != null ? $post->category->name : 'Senza categoria' }}</td>
                                        <td>{{ $post->slug }}</td>
                                        <td>{{ Str::limit($post->content, 20, '...') }}</td>
                                        <td>
                                            @if ($post->approved == 1)
                                                <span class="badge-approved">Approvato</span>
                                            @elseif($post->approved == 2)
                                                <span class="badge-not-approved">Non approvato</span>
                                            @else
                                                <span class="badge-on-approvation">In approvazione</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">

                                                <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}"
                                                    title="Visualizza post" class="primary-button-sm me-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}"
                                                    title="Modifica post" class="warning-button-sm me-1">
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
                                                    data-bs-target="#modal_post_delete" data-id="{{ $post->id }}"
                                                    data-title="{{ $post->title }}" data-type="posts">
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
                @include('admin.posts.partials.modal_delete')
            @else
                <h4 class="text-center">Non hai inserito ancora dei post. Aggiungine almeno uno per visualizzarli nella tua
                    tabella.</h4>
            @endif
        </div>
    </div>
@endsection
