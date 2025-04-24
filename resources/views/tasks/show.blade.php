<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    @php
        $priorityClasses = [
            'low' => '!text-green-700',
            'medium' => '!text-yellow-700',
            'high' => '!text-orange-700',
            'urgent' => '!text-red-700',
        ];
    @endphp

    <div class="py-6">
        <x-main-container>
            <x-secondary-container class="px-3 py-6 m-auto md:w-3/4">
                <div class="mb-4">
                    <h2 class=" text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight text-center p-3 border rounded-md !border-[{{ $task->category->color_code ?? '#000' }}]">
                        {{ $task->title }}
                        <span class="ml-3 text-lg font-bold {{ $priorityClasses[$task->priority] }}">
                        {{ "[". Str::upper($task->priority ) ."]" }}
                        </span>
                    </h2>
                    <div class="flex flex-row justify-between mt-4">
                        <div>
                            <x-text class="text-lg font-thin">
                                {{ $task->description }}
                            </x-text>
                            <x-text>Due Date: {{ $task->due_date->format('d-m-Y') }}</x-text>
                            <x-text>
                                Category:
                                <span
                                    class="!text-[{{ $task->category->color_code }}]">
                            {{ $task->category->name ?? 'None' }}
                        </span>
                            </x-text>
                        </div>
                        <div>
                            <x-text class="text-sm font-thin">
                                Created at: {{ $task->created_at->format('d-m-Y H:i') }}
                            </x-text>
                            <x-text class="text-sm font-thin">
                                Updated at: {{ $task->updated_at->format('d-m-Y H:i') }}
                            </x-text>
                            <div>
                                <form action="{{ route('tasks.update.status', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($task->status === "completed")
                                        <x-text class="text-sm font-thin">
                                            Status: <span class="text-green-700">Completed</span>
                                        </x-text>
                                        <x-danger-button name="status" value="incomplete">
                                            Mark as Incomplete
                                        </x-danger-button>
                                    @elseif($task->status === "incomplete")
                                        <x-text class="text-sm font-thin">
                                            Status: <span class="text-red-700">Incomplete</span>
                                        </x-text>
                                        <x-primary-button class="!bg-green-500 !hover:bg-green-600 !text-white"
                                                          name="status" value="completed">
                                            Mark as Completed
                                        </x-primary-button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <x-text class="flex flex-row flex-wrap gap-4 mt-4 border w-fit p-4 rounded-lg">
                        @if($task->taskAttachment->isNotEmpty())
                            @foreach($task->taskAttachment as $attachment)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/attachments/' . $attachment->file_path) }}"
                                       target="_blank"
                                       class="text-blue-600 hover:underline">
                                        {{ $attachment->file_name }} ({{ round($attachment->file_size / 1024, 2) }} KB)
                                    </a>

                                    @if(preg_match('/\.(jpg|jpeg|png|gif|webp|bmp)$/i', $attachment->file_name))
                                        <img src="{{ asset('storage/attachments/' . $attachment->file_path) }}"
                                             alt="preview"
                                             class="mt-2 rounded-md border w-48 h-auto shadow-sm">
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </x-text>
                </div>
                <div class="flex flex-row justify-between mt-4">

                    <a href="{{route('tasks.edit', $task->id)}}">
                        <x-primary-button type="button">
                            {{ __('Edit Task') }}
                        </x-primary-button>
                    </a>
                    <x-link-button href="{{ route('tasks.index') }}">
                        {{ __('Back to Tasks') }}
                    </x-link-button>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit">
                            {{ __('Delete Task') }}
                        </x-danger-button>
                    </form>
                </div>
            </x-secondary-container>

{{--            Comments --}}
            <x-secondary-container class="mt-10 px-3 py-6 m-auto md:w-3/4">
                <x-text class="text-lg font-semibold mb-2">Comments</x-text>
                @foreach ($task->taskComment as $comment)
                    <div class="p-3 border rounded-lg mb-2 w-3/4 bg-white">
                        <p class="text-sm text-gray-700">
                            <strong>{{ $comment->user->name }}</strong> commented:
                        </p>
                        <p class="text-gray-900">{{ $comment->comment }}</p>
                        <p class="mt-2 text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach

                {{-- Form to add a new comment --}}
                <form action="{{ route('task-comments.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <x-input-label for="comment" :value="__('Add a comment')" />
                    <textarea id="comment" name="comment" rows="4"
                              class="block mt-2 mb-4 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                              placeholder="Add a comment..." required>
                    </textarea>
                    <x-link-button>Post Comment</x-link-button>
                </form>
            </x-secondary-container>

{{--            Task history --}}
            <x-secondary-container class="mt-10 px-3 py-6 m-auto md:w-3/4">
                <div class="flex flex-col gap-2">
                    <x-text class="text-lg font-semibold !p-1 !mb-2">Task history</x-text>
                    @if($task->taskHistory->isNotEmpty())
                        <x-text class="space-y-2">
                            @foreach($task->taskHistory as $history)
                                <div class="border rounded-lg px-4 py-2">
                                    <p><strong>User:</strong> {{ $history->user->name ?? 'Unknow' }}</p>
                                    <p><strong>Field:</strong> {{ ucfirst($history->action) }}</p>
                                    <p><strong>Old Value:</strong> {{ $history->old_value }}</p>
                                    <p><strong>New Value:</strong> {{ $history->new_value }}</p>
                                    <p><small
                                            class="text-gray-500">{{ $history->created_at->format('d/m/Y H:i') }}</small>
                                    </p>
                                </div>
                            @endforeach
                        </x-text>
                    @else
                        <p class="text-gray-500">{{ __('No changes has been made.') }}</p>
                    @endif
                </div>
            </x-secondary-container>
        </x-main-container>
    </div>
</x-app-layout>
