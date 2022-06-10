<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new contact') }}
        </h2>
    </x-slot>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form action="{{ route('contacts.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
            @csrf
            <x-jet-validation-errors class="mb-4" />
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Type name" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Email" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Type email" />
            </div>
            <div class="flex justify-end">
                <x-jet-button class="mr-4">
                    {{ __('Add') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</x-app-layout>
