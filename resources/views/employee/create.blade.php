<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Add Employee') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <form action="{{ route('employees.store') }}" method="post" class="space-y-6">
          @csrf
          <div>
            <x-input-label for="department_id" :value="__('Department')" />
            <x-select name="department_id" id="department_id">
              @foreach ($departments as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </x-select>
            <x-input-error class="mt-2" :messages="$errors->get('department_id')" />
          </div>
          <div>
            <x-input-label for="position" :value="__('Position')" />
            <x-select name="position" id="position">
              <option value="MANAGER">manager</option>
              <option value="STAFF">staff</option>
              <option value="ADMIN">admin</option>
            </x-select>
            <x-input-error class="mt-2" :messages="$errors->get('position')" />
          </div>
          <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')"
              required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
          </div>
          <div>
            <x-input-label for="salary" :value="__('Salary')" />
            <x-text-input id="salary" name="salary" type="number" class="mt-1 block w-full" :value="old('salary')"
              required autofocus autocomplete="salary" />
            <x-input-error class="mt-2" :messages="$errors->get('salary')" />
          </div>
          <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
