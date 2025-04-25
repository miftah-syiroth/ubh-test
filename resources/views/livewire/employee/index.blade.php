<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <div class="bg-white dark:bg-gray-900 p-4">
    <div class="flex justify-between items-center">
      <div>
        <x-primary-link href="{{ route('employees.create') }}">Add Employee</x-primary-link>
      </div>
      <div>
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
          <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
          </div>
          <input type="text" wire:model.live.debounce.300ms="search"
            class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Search for items">
        </div>
      </div>
    </div>
    @if (count($checkedItems))
      <div class="mt-4">
        <x-danger-button wire:click="bulkDelete" wire:confirm="Are you sure you want to delete these items?">
          Delete
        </x-danger-button>
      </div>
    @endif
  </div>
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="p-4">
          <div class="flex items-center">
            <input wire:model.live="checkAll" type="checkbox"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-all-search" class="sr-only">checkbox</label>
          </div>
        </th>
        <th scope="col" class="px-6 py-3">
          Department
        </th>
        <th scope="col" class="px-6 py-3">
          Name
        </th>
        <th scope="col" class="px-6 py-3">
          Position
        </th>
        <th scope="col" class="px-6 py-3">
          Salary
        </th>
        <th scope="col" class="px-6 py-3">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($employees as $item)
        <tr
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
          <td class="w-4 p-4">
            <div class="flex items-center">
              <input wire:model.live="checkedItems" value="{{ $item->id }}" type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
            </div>
          </td>
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $item->department?->name }}
          </th>
          <td class="px-6 py-4">
            {{ $item->name }}
          </td>
          <td class="px-6 py-4">
            {{ $item->position }}
          </td>
          <td class="px-6 py-4">
            {{ $item->salary }}
          </td>
          <td class="px-6 py-4">
            <div class="flex gap-2">
              <a href="{{ route('employees.edit', $item->id) }}"
                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
              <button wire:click="deleteDepartment({{ $item->id }})"
                wire:confirm="Are you sure you want to delete this item?"
                class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @if ($employees->hasPages())
    <div class="bg-white dark:bg-gray-900 p-4">
      {{ $employees->links(data: ['scrollTo' => false]) }}
    </div>
  @endif
</div>
