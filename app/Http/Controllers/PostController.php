<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.all', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate request
        $this->postValidator($request);

        $post = new Post();
        // Create Image
        $post = $this->postCreatorAndUpdater($request, $post);

        $user = auth()->user();
        return view('profile.view', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $this->postCreatorAndUpdater($request, $post);

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $this->deleteImageFromStorage($post);
        $post->delete();

        return redirect()->back();
    }

    /**
     * Checks Validation for posts
     *
     * @param  mixed $request
     * @return void
     */
    public function postValidator(Request $request)
    {
        // Validate request
        return $request->validate([
            'title' => 'required|max:120',
            'content' => 'required|max:500',
            'image' => 'nullable|image|max: 2048'
        ]);
    }

    /**
     * Handles Post: Storage/Updates DB and Post Image
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return Post
     */
    public function postCreatorAndUpdater(Request $request, Post $post): Post
    {
        // Create unique image name
        if ($request->hasFile('image')) {

            // Delete existing File from storage
            $this->deleteImageFromStorage($post);
            // Store image and get storage path with filename
            $fileName = $request->file('image')->store(config('app.image_folder_url'), ['disk' => 'public']);

            // Store image name in database
            $post->image = str_replace('images/', '', $fileName);
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = auth()->user()->id;
        $post->save();
        return $post;
    }

    /**
     * deleteImageFromStorage
     *
     * @param  mixed $post
     * @return void
     */
    public function deleteImageFromStorage(Post $post): void
    {
        $file_path = public_path(config('app.uploads_folder_url') . '/' . config('app.image_folder_url') . '/' . $post->image);
        if (File::exists($file_path)) File::delete($file_path);
    }
}