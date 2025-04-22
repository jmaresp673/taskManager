<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new task') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <x-main-container>
            <x-secondary-container class="p-6">
                <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Title')"/>
                        <x-text-input id="title" name="title" value="{{ old('title') }}" required autofocus/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')"/>
                        <textarea id="description" name="description" rows="4"
                                  class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        {{ old('description') }}
                    </textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="due_date" :value="__('Due Date')"/>
                        <x-input-date id="due_date" name="due_date" value="{{ old('due_date') }}" required/>
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2"/>
                    </div>

                    <div class="mb-4">
                        @php
                            $priorityClasses = [
                                'low' => '!text-green-500',
                                'medium' => '!text-yellow-500',
                                'high' => '!text-orange-500',
                                'urgent' => '!text-red-500',
                            ];
                        @endphp
                        <x-input-label for="priority" :value="__('Priority')"/>
                        <x-input-select id="priority" name="priority" class="block mt-1 w-full transition-all duration-500  {{ old('priority') ? $priorityClasses[old('priority')] : '' }}" onchange="updatePriorityColor(this)">
                            <option value="">Select Priority</option>
                            <option class="{{ $priorityClasses['low'] }}" value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option class="{{ $priorityClasses['medium'] }}" value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option class="{{ $priorityClasses['high'] }}" value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            <option class="{{ $priorityClasses['urgent'] }}" value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </x-input-select>
                        <x-input-error :messages="$errors->get('priority')" class="mt-2"/>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="category_id" :value="__('Category')"/>
                        <x-input-select id="category_id" name="category_id" class="block mt-1 w-full">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-input-select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="file" :value="__('File Attachment (optional)')"/>
                        <x-file-input id="task_attachment" name="task_attachment[]" multiple class="block mt-1 w-full"/>
                        <x-input-error :messages="$errors->get('task_attachment[]')" class="mt-2"/>
                    </div>
                    <div class="flex flex-row justify-end mt-4">
                        <x-primary-button>
                            {{ __('Create Task') }}
                        </x-primary-button>
                        <a href="{{ route('tasks.index') }}" class="ml-4">
                            <x-danger-button type="button">
                                {{ __('Cancel') }}
                            </x-danger-button>
                        </a>
                    </div>
                </form>
            </x-secondary-container>
        </x-main-container>
    </div>
</x-app-layout>
<script>
    function updatePriorityColor(selectElement) {
        const priorityClasses = {
            low: '!text-green-500',
            medium: '!text-yellow-500',
            high: '!text-orange-500',
            urgent: '!text-red-500',
        };

        // delete all priority classes
        selectElement.classList.remove(...Object.values(priorityClasses));

        // Adds the selected priority class
        const selectedValue = selectElement.value;
        if (priorityClasses[selectedValue]) {
            selectElement.classList.add(priorityClasses[selectedValue]);
        }
    }
</script>
