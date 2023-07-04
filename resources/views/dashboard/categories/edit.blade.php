<x-app-layout>
  <x-slot name="header">
    <h2
      class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
    >
      {{ __('Categories Management') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="mx-10">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Edit Category') }}
              </h2>
            </header>

            <form
              method="post"
              action="{{ route('dashboard.categories.update', $category->slug) }}"
              class="mt-6 space-y-6"
            >
              @method('PUT')
              @csrf

              <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input
                  id="name"
                  name="name"
                  type="text"
                  class="mt-1 block w-full"
                  :value="old('name', $category->name)"
                  autofocus
                />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
              </div>

              <div>
                <x-input-label for="slug" :value="__('Slug')" />
                <x-text-input
                  id="slug"
                  name="slug"
                  type="text"
                  class="mt-1 block w-full"
                  :value="old('slug', $category->slug)"
                  autocomplete="slug"
                />
                <x-input-error class="mt-2" :messages="$errors->get('slug')" />
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
  const name = document.querySelector("#name");
  const slug = document.querySelector("#slug");

  name.addEventListener("change", async () => {
    try {
      const response = await fetch(
          `/dashboard/categories/check-slug?name=${name.value}`
      );
      const data = await response.json();

      slug.value = data.slug;
    } catch (error) {
      console.error({ error });
    }
  });
</script>
