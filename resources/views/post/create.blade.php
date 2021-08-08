@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Name input -->

                    <div class="form-outline mb-4">
                        <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control"
                            placeholder="Insert title..." />
                    </div>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="image">Add Image</label>
                        <input type="file" class="form-control" id="image" name="image" />
                    </div>

                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <!-- Message input -->
                    <div class="form-outline mb-4">
                        <textarea class="form-control" id="content" name="content" rows="4"
                            placeholder="Your message">{{ old('content') }}</textarea>
                    </div>

                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
