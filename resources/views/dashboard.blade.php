<x-app-layout>
    <x-slot name="header">
        @yield('title')
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboardul ') }}--}}
        </h2>
    </x-slot>

    <div>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">

            @yield('content')
{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                <x-jet-welcome />--}}
            </div>
        </div>
    </div>
</x-app-layout>
