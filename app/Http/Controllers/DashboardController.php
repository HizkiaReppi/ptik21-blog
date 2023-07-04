<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'posts' => Post::paginate(10),
            'categories' => Category::orderBy('name', 'ASC')->paginate(10),
            'users' => User::orderBy('name', 'ASC')->paginate(10),
        ]);
    }
}
