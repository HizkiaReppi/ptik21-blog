<x-post-layout title="{{ $title }}">
    <h2 class="text-center font-bold text-2xl my-5">Posts</h2>

    <div class="flex justify-center">
        <div class="w-3/5">
            <form action="/">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}" />
                    @endif @if (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}" />
                    @endif
                    <div class="flex justify-center items-center gap-1">
                        <x-text-input type="text" class="w-full md:w-1/2 py-2 px-3" placeholder="Search"
                            name="search" value="{{ request('search') }}" />
                        <x-primary-button class="py-3">Search</x-primary-button>
                    </div>
            </form>
        </div>
    </div>

    @if ($posts->count())

        <section class="mx-[6%] mt-5">
            <div class="flex justify-center items-center">
                <div
                    class="flex flex-col items-center h-full placeholder:md:h-80 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-3xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    @if ($posts[0]->image)
                        <img src="{{ asset('storage/post-image/' . $posts[0]->image) }}"
                            class="object-cover w-auto md:w-48 rounded-t-lg h-full md:h-80 md:rounded-none md:rounded-l-lg"
                            alt="{{ $posts[0]->title }}" />
                    @else
                        <img class="object-cover w-full rounded-t-lg h-full md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                            src="https://source.unsplash.com/350x500?{{ $posts[0]->category->name }}"
                            alt="{{ $posts[0]->category->name }}" />
                    @endif
                    <div class="flex flex-col justify-between p-4 w-full leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $posts[0]->title }}
                        </h5>
                        <h6 class="mb-2 text-xs md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
                            By {{ $posts[0]->author->name }} in {{ $posts[0]->category->name }}
                            {{ $posts[0]->created_at->diffForHumans() }}
                        </h6>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {!! strip_tags(Str::limit($posts[0]->content, 350, '...')) !!}
                        </p>
                        <a href="/posts/{{ $posts[0]->slug }}" class="btn-primary m-0 w-36">
                            Read more
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-1 justify-between mt-3">
                @foreach ($posts->skip(1) as $post)
                    <div
                        class="w-full max-w-none md:max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 my-3">
                        <a href="/posts/{{ $post->slug }}">
                            @if ($post->image)
                                <img src="{{ asset('storage/post-image/' . $post->image) }}" class="rounded-t-lg"
                                    alt="{{ $post->title }}" />
                            @else
                                <img class="rounded-t-lg"
                                    src="https://source.unsplash.com/500x350?{{ $post->category->name }}"
                                    alt="{{ $post->category->name }}" />
                            @endif
                        </a>
                        <div class="p-5 flex flex-col justify-between">
                            <div>
                                <a href="/posts/{{ $post->slug }}">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $post->title }}
                                    </h5>
                                </a>
                                <h6 class="mb-2 text-xs font-bold tracking-tight text-gray-900 dark:text-white">
                                    By {{ $post->author->name }} In {{ $post->category->name }}
                                    {{ $post->created_at->diffForHumans() }}
                                </h6>
                            </div>
                            <div class="">
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    {!! strip_tags(Str::limit($post->content, 200, '...')) !!}
                                </p>
                                <a href="/posts/{{ $post->slug }}" class="btn-secondary">
                                    Read more
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h2 class="text-center fs-2">Post Tidak Ada</h2>
    @endif

    <div class="flex flex-col justify-between mb-5">{{ $posts->links() }}</div>
    </section>
</x-post-layout>
