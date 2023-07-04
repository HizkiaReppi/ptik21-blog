<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <h5 class="text-2xl font-semibold p-5">Posts</h5>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">No.</th>
                        <th scope="col" class="px-6 py-3 text-center">Title</th>
                        <th scope="col" class="px-6 py-3 text-center">Author</th>
                        <th scope="col" class="px-6 py-3 text-center">Category</th>
                        <th scope="col" class="px-6 py-3 text-center">Published</th>
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
                                {{ $post->category->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ Carbon\Carbon::parse($post->published_at)->format('H:i, d F Y') }}</td>
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
