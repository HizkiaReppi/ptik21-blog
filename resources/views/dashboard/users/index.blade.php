<x-app-layout title="{{ $title }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @can('super-admin')
                    <a href="{{ route('dashboard.users.create') }}" class="btn-primary">Add User</a>
                @endcan
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">No.</th>
                                <th scope="col" class="px-6 py-3 text-center">Fullname</th>
                                <th scope="col" class="px-6 py-3 text-center">Username</th>
                                <th scope="col" class="px-6 py-3 text-center">Email</th>
                                <th scope="col" class="px-6 py-3 text-center">Status</th>
                                <th scope="col" class="px-6 py-3 text-center">Last Seen</th>
                                <th scope="col" class="px-6 py-3 text-center">Total Posts</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 text-center">
                                        {{ $users->perPage() * ($users->currentPage() - 1) + $loop->index + 1 }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-left text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->name }}
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        {{ $user->username }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($user->hasVerifiedEmail())
                                            <span class="text-green-500">Verified</span>
                                        @else
                                            <span class="text-red-500">Not Verified</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($user->isOnline())
                                            <span class="text-green-500">Online</span>
                                        @else
                                            <span class="text-gray-700">
                                                {{ $user->lastActivityAgo() }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $posts->where('user_id', $user->id)->count() }}
                                    </td>
                                    <td class="flex items-center justify-center px-6 py-4 space-x-3">
                                        <a href="{{ route('dashboard.users.show', $user->username) }}"
                                            class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                            Show
                                        </a>
                                        @if ($user->role !== 'super-admin')
                                            <a href="{{ route('dashboard.users.edit', $user->username) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                Edit
                                            </a>
                                            @can('super-admin')
                                                <a href="{{ route('dashboard.users.destroy', $user->username) }}"
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                    data-confirm-delete="true">
                                                    Remove
                                                </a>
                                            @endcan
                                        @else
                                            <button type="button" class="font-medium text-gray-900 dark:text-gray-300">
                                                Edit
                                            </button>
                                            @can('super-admin')
                                                <button type="button" class="font-medium text-gray-900 dark:text-gray-300">
                                                    Remove
                                                </button>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex flex-col justify-between m-5">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
