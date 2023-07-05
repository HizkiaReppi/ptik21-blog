<x-app-layout title="{{ $title }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">No.</th>
                                <th scope="col" class="px-6 py-3 text-center">Title</th>
                                <th scope="col" class="px-6 py-3 text-center">Author</th>
                                <th scope="col" class="px-6 py-3 text-center">Published</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 text-center">
                                        {{ $posts->perPage() * ($posts->currentPage() - 1) + $loop->index + 1 }}</td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-left text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $post->title }}
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        {{ $post->author->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ Carbon\Carbon::parse($post->published_at)->format('H:i, d F Y') }}</td>
                                    <td class="flex items-center justify-center px-6 py-4 space-x-3">
                                        <a href="{{ route('dashboard.posts.show', $post->slug) }}"
                                            class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                            Show
                                        </a>
                                        @can('super-admin')
                                            <a href="{{ route('dashboard.posts.edit', $post->slug) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                Edit
                                            </a>
                                            <a href="{{ route('dashboard.posts.destroy', $post->slug) }}"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                data-confirm-delete="true">
                                                Remove
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            @if ($posts->count() < 1)
                                <tr>
                                    <td colspan="5"
                                        class="text-center py-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Post Not Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="flex flex-col justify-between m-5">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
