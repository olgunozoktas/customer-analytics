<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Son 3 Günlük Londra Hava Durumu Bilgileri
        </h2>
    </x-slot>

    <div class="py-8" id="weathers">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <weathers></weathers>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/weather.js?id=' . uniqid()) }}"></script>
