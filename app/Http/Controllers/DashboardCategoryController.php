<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DashboardCategoryController extends Controller
{
    /**
     * Authorize of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->confirmDeleteSweetalert();
        return view('dashboard.categories.index', [
            'title' => 'Category Management',
            'categories' => Category::orderBy('name', 'ASC')->paginate(10),
            'posts' => Post::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.categories.create', [
            'title' => 'Add New Category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        Category::create($validatedData);

        return Redirect::route('dashboard.categories.index')->with('toast_success', 'Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        $this->confirmDeleteSweetalert();
        return view('dashboard.categories.show', [
            'title' => 'Category' . $category->name,
            'posts' => Post::where('category_id', $category->id)->paginate(10),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('dashboard.categories.edit', [
            'title' => 'Edit Category',
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $validatedData = $request->validated();

        Category::where('id', $category->id)->update($validatedData);

        return Redirect::route('dashboard.categories.index')->with('toast_success', 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        Category::destroy($category->id);

        return Redirect::route('dashboard.categories.index')->with('toast_success', 'Category Deleted Successfully!');
    }

    public function checkSlug(Request $request): JsonResponse
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
