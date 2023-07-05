<x-app-layout title="{{ $title }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
                                {{ __('Edit User') }}
                            </h2>
                        </header>

                        <form method="post" action="{{ route('dashboard.users.update', $user->username) }}"
                            class="mt-6 space-y-6">
                            @method('PATCH')
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Full Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $user->name)" autofocus required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="username" :value="__('Username')" />
                                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                                    :value="old('username', $user->username)" autocomplete="username" required />
                                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    :value="old('email', $user->email)" autocomplete="email" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            @can('super-admin')
                                <div>
                                    <x-input-label for="role" :value="__('Role')" />
                                    <select name="role" id="role"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach ($roles as $role)
                                            @if (old('role', $role['value']) == $user->role)
                                                <option value="{{ $role['value'] }}" selected>{{ $role['name'] }}</option>
                                            @else
                                                <option value="{{ $role['value'] }}">{{ $role['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                                </div>

                                <div id="passwordField" class="hidden">
                                    <x-input-label for="confirmAdminPassword" :value="__('Confirm Your Password')" />
                                    <x-text-input id="confirmAdminPassword" name="confirmAdminPassword" type="password"
                                        class="mt-1 block w-full" />
                                    <x-input-error class="mt-2" id="errorPassword" :messages="$errors->get('confirmAdminPassword')" />
                                </div>
                            @endcan
                            <div>
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" name="password" type="password"
                                    class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
    const passwordField = document.querySelector('#passwordField')
    const role = document.querySelector('#role')

    role.addEventListener('change', () => {
        if (role.value === 'super-admin') {
            passwordField.classList.remove('hidden')
        } else {
            passwordField.classList.add('hidden')
        }
    })
</script>
