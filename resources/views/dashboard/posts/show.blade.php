<x-post-layout>
    <div class="mx-[3%] my-5">
        <div class="flex justify-between gap-5">
            <div class="w-full bg-white rounded-lg px-16 py-10">
                <h1 class="text-4xl lg:text-5xl font-bold">{{ $post->title }}</h1>

                <div class="flex flex-wrap justify-between text-base font-medium text-gray-700 my-5">
                    <div class="flex flex-wrap justify-between lg:justify-normal">
                        <a href="{{ route('dashboard.posts.index') }}" class="btn-green w-full lg:w-auto">Back To Post
                            Management</a>
                        @if(auth()->user()->role === 'super-admin')
                            <a href="{{ route('dashboard.posts.edit', $post->slug) }}"
                                class="btn-yellow w-[45%] lg:w-auto">Edit</a>
                            <a href="{{ route('dashboard.posts.destroy', $post->slug) }}" class="btn-red w-[45%] lg:w-auto"
                                data-confirm-delete="true">Remove</a>
                        @elseif(auth()->user()->id === $post->author->id)
                            <a href="{{ route('dashboard.posts.edit', $post->slug) }}"
                                class="btn-yellow w-[45%] lg:w-auto">Edit</a>
                            <a href="{{ route('dashboard.posts.destroy', $post->slug) }}" class="btn-red w-[45%] lg:w-auto"
                                data-confirm-delete="true">Remove</a>
                        @endif
                    </div>
                    <p>
                        In {{ $post->category->name }} | {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>

                @if ($post->image)
                    <img src="{{ asset('storage/post-image/' . $post->image) }}" class="w-full"
                        alt="{{ $post->title }}" />
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="w-full"
                        alt="{{ $post->category->name }}" />
                @endif

                <article class="my-3 w-full leading-loose text-xl text-gray-700 dark:text-gray-600 text-justify">
                    {!! $post->content !!}
                </article>

                <hr class="my-3 border-[0.2px] border-gray-300" />

                <a href="{{ url()->previous() }}" class="text-decoration-none">Back to Post Management</a>
            </div>
        </div>
    </div>
</x-post-layout>
