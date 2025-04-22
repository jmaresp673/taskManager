<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deleted Tasks') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <x-main-container>
            <x-secondary-container>

                @if (session('success'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($tasks->isEmpty())
                    <x-text class="!text-gray-600">There's no removed tasks.</x-text>
                @else
                    <table
                        class="w-full pr-3 pl-8 py-3 rounded-lg bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left font-bold text-xl">
                                <x-text class="text-center">Task</x-text>
                            </th>
                            <th class="py-2 px-4 border-b text-left font-bold text-xl">
                                <x-text class="text-center">Category</x-text>

                            </th>
                            <th class="py-2 px-4 border-b text-left font-bold text-xl">
                                <x-text class="text-center">Priority</x-text>

                            </th>
                            <th class="py-2 px-4 border-b text-left font-bold text-xl">
                                <x-text class="text-center">Description</x-text>
                            </th>
                            <th class="py-2 px-4 border-b text-left font-bold text-xl">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="py-2 px-4 border-b">
                                        <x-text class="text-center">{{ $task->title }}</x-text>
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
                                    <x-text class="text-center !text-sm !text-gray-500">{{ $task->description }}</x-text>
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <form action="{{ route('tasks.restore', $task->id) }}" method="POST">
                                        @csrf
                                        <x-primary-button class="!bg-green-500 !hover:bg-green-600 !text-white">
                                            Restore Task
                                        </x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $tasks->links() }}
                    </div>
                @endif
                <div class="mt-6">
                    <a href="{{ route('tasks.index') }}" class="!text-blue-500 !underline p-3">← Back to tasks</a>
                </div>
            </x-secondary-container>
        </x-main-container>
    </div>
</x-app-layout>
