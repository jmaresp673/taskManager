<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit a task') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <x-main-container>
            <x-secondary-container class="px-10 py-6">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Title')"/>
                        <x-text-input id="title" class="block mt-1 w-full" name="title" value="{{ $task->title }}" required autofocus/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')"/>
                        <x-text-input id="description" class="block mt-1 w-full" name="description" value="{{ $task->description }}" required/>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="due_date" :value="__('Due Date')"/>
                        <x-input-date id="due_date" class="block mt-1 w-full" name="due_date" value="{{ $task->due_date->format('Y-m-d') }}" required/>
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
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
                        <x-input-select id="priority" name="priority" class="transition-all duration-500 block mt-1 w-full {{ $priorityClasses[$task->priority] }}" onchange="updatePriorityColor(this)">
                            <option class="{{ $priorityClasses['low'] }}" value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                            <option class="{{ $priorityClasses['medium'] }}" value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option class="{{ $priorityClasses['high'] }}" value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                            <option class="{{ $priorityClasses['urgent'] }}" value="urgent" {{ $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </x-input-select>
                        <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="category_id" :value="__('Category')"/>
                        <x-input-select id="category_id" name="category_id" class="block mt-1 w-full">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $task->category_id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </x-input-select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="flex justify-between">
                        <x-primary-button class="mt-4">
                            {{ __('Update') }}
                        </x-primary-button>
                        <x-link-button class="mt-4" href="{{ route('tasks.index') }}">
                            {{ __('Back to Tasks') }}
                        </x-link-button>
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
