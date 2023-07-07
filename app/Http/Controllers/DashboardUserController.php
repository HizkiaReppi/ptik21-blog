<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('viewAny', User::class);
        $this->confirmDeleteSweetalert();
        return view('dashboard.users.index', [
            'title' => 'User Management',
            'users' => User::orderBy('name', 'ASC')->paginate(10),
            'posts' => Post::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', User::class);
        return view('dashboard.users.create', [
            'title' => 'Add New User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', User::class);
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'username' => ['required', 'string', 'max:255', 'alpha_num:ascii', 'unique:' . User::class],
            'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.regex' => 'The fullname field may only contain letters.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return Redirect::route('dashboard.users.index')->with('toast_success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        $this->authorize('view', User::class);
        $this->confirmDeleteSweetalert();
        return view('dashboard.users.show', [
            'title' => 'User ' . $user->name,
            'posts' => Post::where('user_id', $user->id)->paginate(10),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $this->authorize('update', User::class);
        $roles = [
            [
                'value' => 'user',
                'name' => 'User',
            ],
            [
                'value' => 'admin',
                'name' => 'Admin',
            ],
            [
                'value' => 'super-admin',
                'name' => 'Super Admin',
            ],

        ];
        return view('dashboard.users.edit', [
            'title' => 'Edit User',
            'user' => $user,
            'roles' => collect($roles)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', User::class);
        $validatedData = $request->validated();

        if ($validatedData['role'] === 'super-admin') {
            $confirmPassword = $validatedData['confirmAdminPassword'];

            if (!Hash::check($confirmPassword, auth()->user()->password)) {
                return redirect()->back()->withErrors(['confirmAdminPassword' => 'Invalid password confirmation.']);
            }
        }
        unset($validatedData['confirmAdminPassword']);

        User::where('id', $user->id)->update($validatedData);

        return Redirect::route('dashboard.users.index')->with('toast_success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', User::class);
        User::destroy($user->id);

        return Redirect::route('dashboard.users.index')->with('toast_success', 'User Deleted Successfully!');
    }
}
