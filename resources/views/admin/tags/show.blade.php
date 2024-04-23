@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><strong>Tag: </strong>{{ $tag->name }}</h2>
                <p><strong>Slug: </strong>{{ $tag->slug }}</p>
                <div class="row">
                    @forelse ($tag->posts as $post)
                        <div class="col-12 col-md-3">
                            <a href="{{ route('admin.posts.show', $post->id) }}">
                                <div class="card">
                                    <img src="{{ $post->cover_image ? asset('/storage/' . $post->cover_image) : asset('/img/aaaabbbb.jpg') }}"
                                        alt="" class="card-image-top">
                                    <div class="card-body">
                                        <h4>{{ $post->title }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <h3>Non ci sono post per questo tag</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
