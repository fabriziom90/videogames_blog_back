@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    Aggiungi nuova categoria
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
                <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-3">
                        <label for="name" class="control-label">Nome</label>
                        <input type="text" name="name" id="name" placeholder="Titolo"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="preview">
                        <img id="preview-image" src="" alt="">
                    </div>
                    <input type="file" name="cover_image" id="cover_image"
                        class="form-control @error('cover_image') is-invalid @enderror" value="{{ old('cover_image') }}">
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
