<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-gray-400 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('items')
            </div>
        </div>
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <livewire:datatables.items-table 
            searchable='false'
            hideable='true'
            />
        </div>
    </div>
</x-app-layout>

