<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form action="{{ route('employees.store') }}" method="post">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="department_id">Department</label>
                            <select name="department_id" id="department_id">
                                @foreach ($departments as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name">
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="position">Position</label>
                            <select name="position" id="position">
                                <option value="MANAGER">manager</option>
                                <option value="STAFF">staff</option>
                                <option value="ADMIN">admin</option>
                            </select>
                            @error('position')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="salary">Salary</label>
                            <input type="number" name="salary" id="salary">
                            @error('salary')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
