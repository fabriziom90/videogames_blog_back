@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (\Session::has('message'))
                    <div class="alert alert-success-primary-blue">
                        <ul class="list-unstyled">
                            <li>{{ \Session::get('message') }}</li>
                        </ul>
                    </div>
                @endif
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <h2>{{ $post->title }}</h2>
                    </div>
                    <div>
                        @if ($post->approved == 1)
                            <span class="badge-approved">Approvato</span>
                        @elseif($post->approved == 2)
                            <span class="badge-not-approved">Non approvato</span>
                        @else
                            <span class="badge-on-approvation">In approvazione</span>
                        @endif
                    </div>
                </div>
                <img src="{{ $post->cover_image !== null ? asset('/storage/' . $post->cover_image) : asset('/img/aaaabbbb.jpg') }}"
                    alt="{{ $post->title }}" width="350">
                <div class="d-flex my-2">
                    @forelse ($post->image_gallery_post as $image)
                        <img src="{{ asset('/storage/' . $image->path) }}" alt="{{ $post->title }}" width="150"
                            class="me-2">
                    @empty
                        <h4>Non ci sono immagini nella galleria</h4>
                    @endforelse
                </div>
                @role('admin')
                    <div class="d-flex align-items-center">
                        <strong class="me-2">Approvazione: </strong>
                        <form action="{{ route('admin.posts.post_edit_status', $post->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="d-flex">
                                <div class="me-2">
                                    <select name="approved" id="approved" class="form-control form-control-sm">
                                        <option value="0" @selected($post->approved == 0)>In approvazione</option>
                                        <option value="1" @selected($post->approved == 1)>Approvato</option>
                                        <option value="2" @selected($post->approved == 2)>Non approvato</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="primary-button-sm">Cambia stato</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endrole
                <p>{{ $post->category ? $post->category->name : 'Senza categoria' }}</p>
                <p>
                    @forelse($post->tags as $tag)
                        {{ $tag->name }}
                    @empty
                        Il post non ha tag assegnati
                    @endforelse
                </p>
                <p>{{ $post->slug }}</p>
                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
@endsection
