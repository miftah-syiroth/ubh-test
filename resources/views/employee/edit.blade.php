<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Update Employee') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <form action="{{ route('employees.update', $employee->id) }}" method="post" class="space-y-6">
          @csrf
          @method('PUT')
          <div>
            <x-input-label for="department_id" :value="__('Department')" />
            <x-select name="department_id" id="department_id">
              @foreach ($departments as $item)
                <option value="{{ $item->id }}" {{ $employee->department_id == $item->id ? 'selected' : '' }}>
                  {{ $item->name }}</option>
              @endforeach
            </x-select>
            <x-input-error class="mt-2" :messages="$errors->get('department_id')" />
          </div>
          <div>
            <x-input-label for="position" :value="__('Position')" />
            <x-select name="position" id="position">
              <option value="MANAGER" {{ $employee->position == 'MANAGER' ? 'selected' : '' }}>manager</option>
              <option value="STAFF" {{ $employee->position == 'STAFF' ? 'selected' : '' }}>staff</option>
              <option value="ADMIN" {{ $employee->position == 'ADMIN' ? 'selected' : '' }}>admin</option>
            </x-select>
            <x-input-error class="mt-2" :messages="$errors->get('position')" />
          </div>
          <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $employee->name)"
              required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
          </div>
          <div>
            <x-input-label for="salary" :value="__('Salary')" />
            <x-text-input id="salary" name="salary" type="number" class="mt-1 block w-full" :value="old('salary', $employee->salary)"
              required autofocus autocomplete="salary" />
            <x-input-error class="mt-2" :messages="$errors->get('salary')" />
          </div>
          <div>
            <x-primary-button>{{ __('Update') }}</x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
