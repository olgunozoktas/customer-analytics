<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Müşteri Listesi
        </h2>
    </x-slot>

    <div class="py-8" id="customers">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <customers captcha="{{ \App\Utils\Captcha::generate() }}"></customers>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/customers.js?id=' . uniqid()) }}"></script>
