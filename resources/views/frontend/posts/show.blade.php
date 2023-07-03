<x-post-layout>
  <div class="mx-[3%] my-5">
    <div class="flex flex-col-reverse lg:flex-row justify-between gap-5">
      <div class="h-full w-full lg:w-3/12 bg-white rounded-lg px-8 py-6">
        <h3 class="text-2xl font-bold mb-2">Similar Posts</h3>

        @foreach ($similarPosts as $similarPost)
        <div
          class="flex flex-col items-center justify-center bg-white border border-gray-200 rounded-lg shadow my-2 md:flex-row md:max-w-3xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
        >
          <div class="flex flex-col w-full justify-between p-4 leading-normal">
            <h5
              class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white"
            >
              {{ $similarPost->title }}
            </h5>
            <h6
              class="mb-2 text-xs font-semibold tracking-tight text-gray-900 dark:text-white"
            >
              By {{ $similarPost->author->name }}
            </h6>
            <p
              class="mb-3 font-normal text-xs text-gray-700 dark:text-gray-400"
            >
              {!! strip_tags(Str::limit($similarPost->content,100, '...')) !!}
            </p>
            <div class="flex justify-between items-center">
              <a
                href="/posts/{{ $similarPost->slug }}"
                class="inline-flex items-center w-24 px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-[8px] text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
              >
                Read more
                <svg
                  aria-hidden="true"
                  class="w-2 h-2 ml-2 -mr-1"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </a>
              <span
                class="text-[10px] font-semibold tracking-tight text-gray-900 dark:text-white"
              >
                {{ $similarPost->created_at->diffForHumans() }}
              </span>
            </div>
          </div>
        </div>
        @endforeach
        <hr class="block lg:hidden mb-3 mt-5 border border-gray-300" />
        <a href="/" class="inline lg:hidden text-decoration-none text-sm"
          >Kembali ke Halaman Utama</a
        >
      </div>
      <div class="w-full lg:w-3/4 bg-white rounded-lg px-8 py-6">
        <h1 class="text-4xl font-bold mb-1.5">{{ $post->title }}</h1>

        <div
          class="flex justify-between text-base font-medium text-gray-700 mb-3"
        >
          <p>By. {{ $post->author->name }} | {{ $post->category->name }}</p>
          {{ $post->created_at->diffForHumans() }}
        </div>

        @if ($post->image)
        <img
          src="{{ asset('storage/post-image/' . $post->image) }}"
          class="w-full"
          alt="{{ $post->title }}"
        />
        @else
        <img
          src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"
          class="w-full"
          alt="{{ $post->category->name }}"
        />
        @endif

        <article
          class="my-3 w-full leading-loose text-xl text-gray-700 dark:text-gray-600 text-justify"
        >
          {!! $post->content !!}
        </article>

        <hr class="my-3 border-[0.2px] border-gray-300" />

        <a href="/" class="text-decoration-none">Kembali ke Halaman Utama</a>
      </div>
    </div>
  </div>
</x-post-layout>
