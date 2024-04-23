@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    Aggiungi nuovo post
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
                <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-3">
                        <label for="title" class="control-label">Titolo</label>
                        <input type="text" name="title" id="title" placeholder="Titolo"
                            class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="cover_image" class="control-label">Immagine di copertina</label>
                        <div id="preview">
                            <img id="preview-image" src="" alt="">
                        </div>
                        <input type="file" name="cover_image" id="cover_image"
                            class="form-control @error('cover_image') is-invalid @enderror"
                            value="{{ old('cover_image') }}">
                        @error('cover_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="" class="control-label">Immagini di galleria</label>
                        <input type="file" name="gallery_images[]" id="cover_image"
                            class="form-control @error('cover_image') is-invalid @enderror" value="{{ old('cover_image') }}"
                            multiple>
                        @error('cover_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="category_id" class="control-label">Seleziona categoria</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Seleziona categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label class="control-label">Seleziona tag</label>
                        <div>
                            @foreach ($tags as $tag)
                                <div class="form-check-inline">
                                    <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}"
                                        class="form-check-input" value="{{ $tag->id }}" @checked(is_array(old('tags')) && in_array($tag->id, old('tags')))>
                                    <label for="" class="form-check-label">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="content" class="control-label">Content</label>
                        <textarea name="content" id="content" cols="100" rows="10" placeholder="Testo"
                            class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <button type="submit" class="primary-button-sm">Salva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
