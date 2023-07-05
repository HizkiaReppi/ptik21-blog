<x-app-layout title="{{ $title }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="mx-10">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Post') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Let's share the wonders in the world of writing! Create your own amazing post and let your brilliant ideas shine.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('dashboard.posts.update', $post->slug) }}"
                            class="mt-6 space-y-6" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    :value="old('title', $post->title)" autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div>
                                <x-input-label for="slug" :value="__('Slug')" />
                                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full"
                                    :value="old('slug', $post->slug)" autocomplete="slug" />
                                <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                            </div>

                            <div>
                                <x-input-label for="category_id" :value="__('Category')" />
                                <x-select :options="$categories" id="category_id" name="category_id" :value="$post->category_id" />
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Post Image')" />
                                @if ($post->image)
                                    <img class="img-preview h-auto w-1/2 mb-2 rounded-lg lg:w-1/4"
                                        src="{{ asset('storage/post-image/' . $post->image) }}"
                                        alt="{{ $post->title }}" />
                                @else
                                    <img class="img-preview h-auto w-1/2 rounded-lg lg:w-1/4" />
                                @endif
                                <x-input-file id="image" name="image" onchange="previewImage()" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <input id="content" type="hidden" name="content"
                                    value="{{ old('content', $post->content) }}">
                                <trix-editor input="content"></trix-editor>
                                <x-input-error class="mt-2" :messages="$errors->get('content')" />
                            </div>

                            <div class="flex items-center">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const title = document.querySelector("#title");
    const slug = document.querySelector("#slug");

    title.addEventListener("change", async () => {
        try {
            const response = await fetch(
                `/dashboard/posts/check-slug?title=${title.value}`
            );
            const data = await response.json();

            slug.value = data.slug;
        } catch (error) {
            console.error({
                error
            });
        }
    });

    document.addEventListener("trix-file-accept", (e) => {
        e.preventDefault();
    });

    const previewImage = () => {
        const image = document.querySelector("#image");
        const imagePreview = document.querySelector(".img-preview");

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = (oFREvent) => {
            imagePreview.src = oFREvent.target.result;
            image.classList.add("mt-2");
        };
    };
</script>
