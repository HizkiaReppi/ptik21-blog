<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <h5 class="text-2xl font-semibold p-5">Users</h5>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">No.</th>
                        <th scope="col" class="px-6 py-3 text-center">Name</th>
                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                        <th scope="col" class="px-6 py-3 text-center">Total Posts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 text-center">
                                {{ $users->perPage() * ($users->currentPage() - 1) + $loop->index + 1 }}</td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-left text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->name }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                @if ($user->isOnline())
                                    <span class="text-green-500">Online</span>
                                @else
                                    <span class="text-red-500">Offline</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $totalPosts->where('user_id', $user->id)->count() }}
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
