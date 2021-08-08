@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($posts as $post)
                <div class="col-12 col-md-3 col-lg-4">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            @if ($post->image)
                                <div class="col-12">
                                    <img src="{{ config('app.uploads_folder_url') }}/{{ config('app.image_folder_url') }}/{{ $post->image }}"
                                        alt="{{ $post->title }}" class="img-fluid" />
                                </div>
                            @endif
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">
                                        {{ $post->content }} </p>
                                    <p class="card-text">
                                        <small class="text-muted">{{ $post->updated_at }}</small>
                                        @php
                                            $related_user = $post->user()->first();
                                        @endphp

                                        <a
                                            href="{{ route('profile.view', ['profile_url' => $related_user->profile_url]) }}">{{ $related_user->name }}</a>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
