@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Tutti i tag</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.tags.create') }}" class="btn btn-sm primary-button">Aggiungi tag</a>
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
                <table class="table" id="table-tags">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Slug</th>
                            <th>N° Posts</th>
                            <th>Strumenti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>{{ count($tag->posts) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.tags.show', ['tag' => $tag->id]) }}"
                                            title="Visualizza categoria" class="primary-button-sm me-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.tags.edit', ['tag' => $tag->id]) }}"
                                            title="Modifica categoria" class="warning-button-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button class="btn-delete delete-button-sm" data-bs-toggle="modal"
                                            data-bs-target="#modal_tag_delete" data-id="{{ $tag->id }}"
                                            data-type="tags" data-title="{{ $tag->title }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.tags.partials.modal_delete')
@endsection
