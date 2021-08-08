@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (isset($post))

                    <form method="POST" action="{{ route('post.update', [$post]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <!-- Name input -->

                        <div class="form-outline mb-4">
                            <input type="text" id="title" name="title" value="{{ $post->title }}" class="form-control"
                                placeholder="Insert title..." />
                        </div>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            @if ($post->image)
                                <div>
                                    <span>Current Image</span>
                                </div>
                                <div>
                                    <img
                                        src="/{{ config('app.uploads_folder_url') }}/{{ config('app.image_folder_url') }}/{{ $post->image }}" />
                                </div>
                            @endif
                            <div class="mt-4">
                                <label class="form-label" for="image">Update
                                    Image</label>
                                <input type="file" class="form-control" id="image" name="image" />

                            </div>
                        </div>

                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="content" name="content" rows="4"
                                placeholder="Your message">{{ $post->content }}</textarea>
                        </div>

                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Submit button -->
                        <button type="submit" class=" btn btn-primary btn-block">Update</button>
                        <a class="btn btn-info mt-2 btn-block"
                            href="{{ route('profile.view', ['profile_url' => auth()->user()->profile_url]) }}">Back to
                            Profile</a>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
