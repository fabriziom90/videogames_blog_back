@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    Modifica categoria
                </h2>
            </div>
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.categories.update', $category->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group my-3">
                        <label for="name" class="control-label">Nome</label>
                        <input type="text" name="name" id="name" placeholder="Titolo"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($category->cover_image != null)
                        <div class="my-3">
                            <img src="{{ asset('/storage/' . $category->cover_image) }}" alt="{{ $category->title }}"
                                width="150">
                        </div>
                    @else
                        <h4>Immagine di copertina non impostata</h4>
                    @endif
                    <label for="cover_image" class="control-label">Immagine di copertina</label>
                    <input type="file" name="cover_image" id="cover_image"
                        class="form-control @error('cover_image') is-invalid @enderror">
                    @error('cover_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group my-3">
                        <button type="submit" class="primary-button-sm">Salva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
