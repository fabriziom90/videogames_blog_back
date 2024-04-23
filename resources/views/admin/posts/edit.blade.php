@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    Modifica post
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
                @if ($error_message != '')
                    <div class="alert alert-danger">
                        {{ $error_message }}
                    </div>
                @endif
                <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group my-3">
                        <label for="title" class="control-label">Titolo</label>
                        <input type="text" name="title" id="title" placeholder="Titolo"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') ?? $post->title }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        @if ($post->cover_image != null)
                            <div class="my-3">
                                <img src="{{ asset('/storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
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
                    </div>
                    <div class="form-group my-3">
                        <label for="" class="control-label">Immagini di galleria</label>
                        <div class="d-flex my-2">
                            @forelse ($post->image_gallery_post as $image)
                                <img src="{{ asset('/storage/' . $image->path) }}" alt="{{ $post->title }}" width="150"
                                    class="me-2">
                            @empty
                                <h4>Non ci sono immagini nella galleria</h4>
                            @endforelse
                        </div>
                        <input type="file" name="gallery_images[]" id="cover_image"
                            class="form-control @error('cover_image') is-invalid @enderror"
                            value="{{ old('cover_image') }}" multiple>
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
                                {{-- CONFRONTO L'ID DELLA CATEGORIA CHE STO CICLANDO CON IL VALORE DELLA FUNZIONE old. TALE VALORE è PARI AL VALORE CONTENUTO NELLA TABELLA SE ATTERRO NELLA PAGINA DI EDIT DA UN'ALTRA PAGINA E (E SOTTOLINEO E) SE IL POSTO CHE STO MODIFICANDO HA UNA CATEGORIA IMPOSTATA, OVVERO $post->category è DIVERSO DA NULL. SE INVECE ATTERRO NELLA PAGINA DALLA FORM PRESENTE IN ESSA, IL VALORE RESTITUITO DALLA FUNZIONE old è QUELLO CHE HO SELEZIONATO NELLA SELECT --}}
                                <option value="{{ $category->id }}" @selected($category->id == old('category_id', $post->category ? $post->category->id : ''))>{{ $category->name }}
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
                                    @if ($errors->any())
                                        <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}"
                                            class="form-check-input" value="{{ $tag->id }}"
                                            {{ in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                                    @else
                                        <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}"
                                            class="form-check-input" value="{{ $tag->id }}"
                                            {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                                    @endif
                                    <label for="" class="form-check-label">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="content" class="control-label">Content</label>
                        <textarea name="content" id="content" cols="100" rows="10" placeholder="Testo"
                            class="form-control @error('content') is-invalid @enderror" required>{{ old('content') ?? $post->content }}</textarea>
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
