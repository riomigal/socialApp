@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-2 my-2">
                <h1>{{ $user->name }}</h1>
            </div>
            @php
                $posts = $user->posts()->get();
            @endphp
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="col-12 col-md-3 col-lg-4">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                @if ($post->image)
                                    <div class="col-12">
                                        <img src="/{{ config('app.uploads_folder_url') }}/{{ config('app.image_folder_url') }}/{{ $post->image }}"
                                            alt="..." class="img-fluid" />
                                    </div>
                                @endif
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">
                                            {{ $post->content }} </p>
                                        <p class="card-text">
                                            <small class="text-muted">{{ $post->updated_at }}</small>

                                        </p>
                                    </div>
                                    @if ($user->id === auth()->user()->id)
                                        <div class="d-flex flex-wrap">
                                            <a href="{{ route('post.edit', [$post]) }}"
                                                class="m-2 btn btn-primary">Edit</a>
                                            <form method="POST" action="{{ route('post.destroy', ['post' => $post]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="m-2 btn btn-danger">X</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No Posts. <a class="btn btn-primary" href="{{ route('post.create') }}">Create Post</a>
                </p>
            @endif
        </div>
    </div>
@endsection
