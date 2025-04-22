<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    {{-- Sorting --}}
    @php
        $currentSortBy = request('sort_by');
        $currentDirection = request('sort_direction');

        /**
        * Get the next sorting parameters based on the current column and direction.
        *
        * @param $column
        * @return array
        */
        function nextSortParams($column) {
            $currentBy = request('sort_by');
            $currentDir = request('sort_direction');

            // if the current column is not the one being sorted, reset to ascending
            if ($currentBy !== $column) return ['sort_by' => $column, 'sort_direction' => 'asc'];
            // if the current column is the one being sorted, toggle the direction
            if ($currentDir === 'asc') return ['sort_by' => $column, 'sort_direction' => 'desc'];
            if ($currentDir === 'desc') return []; //  no sorting
            return ['sort_by' => $column, 'sort_direction' => 'asc'];
            // the order is asc -> desc -> none
        }

        /**
        *  Get the sort icon based on the current column and direction.
        * @param $column
        * @return string
        */
        function sortIcon($column) {
            // if the current column is not the one being sorted, return empty string
            if (request('sort_by') !== $column) return '';
            // if the current column is the one being sorted, return the icon based on the direction
            $sortDirection = request('sort_direction');
            return $sortDirection === 'asc' ? '↑' : ($sortDirection === 'desc' ? '↓' : '');
        }
    @endphp

    <div class="py-6">
        <x-main-container>
            {{-- Search/filter form --}}
            <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap gap-4 mb-6">
                <x-text-input type="text" name="search" value="{{ request('search') }}" placeholder="Search title..."/>

                <x-input-select name="status">
                    <option value="">All Status</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                    </option>
                    <option value="incomplete" {{ request('status') == 'incomplete' ? 'selected' : '' }}>Incomplete
                    </option>
                </x-input-select>

                <x-input-select name="priority">
                    <option value="">All Priorities</option>
                    @foreach(['low', 'medium', 'high', 'urgent'] as $priority)
                        <option value="{{ $priority }}" {{ request('priority') == $priority ? 'selected' : '' }}>
                            {{ ucfirst($priority) }}
                        </option>
                    @endforeach
                </x-input-select>

                <x-input-select name="category_id">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-input-select>

                <x-input-date name="due_date" value="{{ request('due_date') }}"/>

                <x-primary-button>
                    {{ __('Search') }}
                </x-primary-button>
                <a href="{{ route('tasks.index') }}">
                    <x-danger-button type="button" class="h-full">
                        {{-- This button is not a form submit button, so we use type="button" --}}
                        {{-- to prevent it from submitting the form --}}
                        {{ __('Clean filters') }}
                    </x-danger-button>
                </a>

                <x-link-button type="button" href="{{ route('tasks.create') }}">
                    {{ __('Create Task') }}
                </x-link-button>
            </form>


            @if($tasks && $tasks->count() > 0)
                <table class="w-full pr-3 pl-8 py-3 rounded-lg bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
                    <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left font-bold text-xl">
                            <a href="{{ route('tasks.index', array_merge(request()->except(['page', 'sort_by', 'sort_direction']), nextSortParams('title'))) }}">
                                <x-text class="text-center">Task {!! sortIcon('title') !!}</x-text>
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b text-left font-bold text-xl">
                            <a href="{{ route('tasks.index', array_merge(request()->except(['page', 'sort_by', 'sort_direction']), nextSortParams('category_id'))) }}">
                                <x-text class="text-center">Category {!! sortIcon('category_id') !!}</x-text>
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b text-left font-bold text-xl">
                            <a href="{{ route('tasks.index', array_merge(request()->except(['page', 'sort_by', 'sort_direction']), nextSortParams('priority'))) }}">
                                <x-text class="text-center">Priority {!! sortIcon('priority') !!}</x-text>
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b text-left font-bold text-xl">
                            <a href="{{ route('tasks.index', array_merge(request()->except(['page', 'sort_by', 'sort_direction']), nextSortParams('created_at'))) }}">
                                <x-text class="text-center">Creation Date {!! sortIcon('created_at') !!}</x-text>
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b text-left font-bold text-xl">
                            <a href="{{ route('tasks.index', array_merge(request()->except(['page', 'sort_by', 'sort_direction']), nextSortParams('due_date'))) }}">
                                <x-text class="text-center">Due Date {!! sortIcon('due_date') !!}</x-text>
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b text-left font-bold text-xl">
                            <x-text class="text-center">Status</x-text>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="py-2 px-4 border-b transition-all duration-200 hover:text-lg cursor-pointer">
                                <a href="{{ route('tasks.show', $task->id) }}">
                                    <x-text class="text-center">{{ $task->title }}</x-text>
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <x-text
                                    class="text-center !text-[{{ $task->category->color_code }}]">{{ $task->category->name ?? 'None' }}</x-text>
                            </td>
                            <td class="py-2 px-4 border-b">
                                @php
                                    $priorityClasses = [
                                        'low' => 'bg-green-200 !border-2 !border-green-500 !text-green-700',
                                        'medium' => 'bg-yellow-200 !border-2 !border-yellow-500 !text-yellow-700',
                                        'high' => 'bg-orange-200 !border-2 !border-orange-500 !text-orange-700',
                                        'urgent' => 'bg-red-200 !border-2 !border-red-500 !text-red-700',
                                    ];
                                @endphp

                                <div
                                    class="h-6 px-4 w-fit {{ $priorityClasses[$task->priority] }} rounded-full text-center m-auto">
                                    <span
                                        class="text-md flex items-center justify-center h-full">{{ $task->priority }}</span>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <x-text class="text-center">{{ $task->created_at->diffForHumans() }}</x-text>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <x-text class="text-center">{{ $task->due_date->diffForHumans() }}</x-text>
                            </td>
                            <td class="py-2 px-4 border-b">
                                @php
                                    $statusClasses = [
                                        'completed' => '!p-1 bg-green-500 !text-black !border-2 !border-green-800 text-md rounded-lg',
                                        'incomplete' => '!p-1 bg-red-500 !text-black !border-2 !border-red-800 font-bold text-md rounded-lg',
                                    ];
                                @endphp
                                <x-text class="text-center {{ $statusClasses[$task->status] }}">
                                    {{ $task->status }}
                                </x-text>
                                {{--                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">--}}
                                {{--                                    @csrf--}}
                                {{--                                    @method('DELETE')--}}
                                {{--                                    <x-danger-button>Delete</x-danger-button>--}}
                                {{--                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $tasks->appends(request()->query())->links() }}<!-- Pagination links -->
                </div>
            @else
                <p class="text-gray-500">No tasks available.</p>
            @endif
            <div class="flex justify-center">
                <x-link-button href="{{ route('tasks.trashed') }}">
                    {{ __('Deleted Tasks') }}
                </x-link-button>
            </div>
        </x-main-container>
    </div>
</x-app-layout>
