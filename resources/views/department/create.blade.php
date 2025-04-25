<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Add Department') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <form action="{{ route('departments.store') }}" method="post" class="space-y-6">
          @csrf
          <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')"
              required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
          </div>
          <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
