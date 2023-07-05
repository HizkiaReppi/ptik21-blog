<x-app-layout title="{{ $title }}">
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" id="clock"></div>
        </div>
    </x-slot>

    <div class="pt-12 pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                    Hello <span id="currentHour"></span> {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </div>


    <div class="py-4">
        @include('dashboard.partials.posts')
    </div>

    <div class="py-4">
        @include('dashboard.partials.users')
    </div>

    <div class="py-4">
        @include('dashboard.partials.categories')
    </div>
</x-app-layout>

<script>
    function updateClock() {
        let now = new Date();
        let hours = now.getHours();
        let minutes = now.getMinutes();

        let formattedTime = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes + (hours <= 12 ?
            ' AM' : ' PM');

        document.getElementById('clock').innerText = formattedTime;

        if (hours >= 5 && hours < 12) {
            document.getElementById('currentHour').innerText = 'Good Morning';
        } else if (hours >= 12 && hours < 18) {
            document.getElementById('currentHour').innerText = 'Good Afternoon';
        } else {
            document.getElementById('currentHour').innerText = 'Good Evening';
        }

        setTimeout(updateClock, 5000);
    }

    updateClock();
</script>
