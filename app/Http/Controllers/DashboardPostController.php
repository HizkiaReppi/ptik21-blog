<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class DashboardPostController extends Controller
{
    /**
     * Authorize of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $title = 'Are you sure?';
        $text = "You won't be able to revert this!";
        confirmDelete($title, $text);
        return view('dashboard.posts.index', [
            'title' => 'Post Management',
            'posts' => Post::latest()->where('user_id', auth()->user()->id)->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.posts.create', [
            'title' => 'Add New Post',
            'categories' => Category::all()->sortBy('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['published_at'] = now();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('post-image', $fileName);

            $image = Image::make(public_path('storage/post-image/' . $fileName))
                ->resize(960, 540);

            $image->save(public_path('storage/post-image/' . $fileName), 90, 'jpg');

            $validatedData['image'] = $fileName;
        }

        Post::create($validatedData);

        return Redirect::route('dashboard.posts.index')->with('toast_success', 'Post Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        $post->increment('views');
        $title = 'Are you sure?';
        $text = "You won't be able to revert this!";
        confirmDelete($title, $text);
        return view('dashboard.posts.show', [
            'title' => $post->name,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return view('dashboard.posts.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'categories' => Category::all()->sortBy('name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $oldImagePath = 'post-image/' . $post->image;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $image = Image::make($file)
                ->resize(960, 540)
                ->encode('jpg', 90);

            $imagePath = 'post-image/' . $fileName;
            Storage::put($imagePath, $image->__toString());

            $validatedData['image'] = $fileName;
        }

        Post::where('id', $post->id)->update($validatedData);

        return Redirect::route('dashboard.posts.index')->with('toast_success', 'Post Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        Post::destroy($post->id);

        return Redirect::route('dashboard.posts.index')->with('toast_success', 'Post Deleted Successfully!');
    }

    public function checkSlug(Request $request): JsonResponse
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
