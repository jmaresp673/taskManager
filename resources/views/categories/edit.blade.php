<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit a category') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <x-main-container>
            <x-secondary-container class="px-10 py-6">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')"/>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                      value="{{ $category->name }}" required autofocus/>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')"/>
                        <x-text-input id="description" class="block mt-1 w-full" type="text"
                                      name="description" value="{{ $category->description }}" required/>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="color_code" :value="__('Color Code')"/>
                        <input type="color" id="color" class="block mt-1" name="color_code"
                               value="{{ $category->color_code }}" required>
                    </div>

                    @if ($category->children()->count() == 0)
                        <div class="mb-4">
                            <x-input-label for="parent_id" :value="__('Parent Category')"/>
                            <x-input-select id="parent_id" name="parent_id" class="block mt-1 w-full">
                                <option value="">None</option>
                                @foreach ($categories as $cat)
                                    @if (!$cat->parent_id)
                                        <option
                                            value="{{ $cat->id }}"{{ $cat->id == $category->parent_id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </x-input-select>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <x-primary-button class="mt-4">
                            {{ __('Update') }}
                        </x-primary-button>
                        <x-link-button class="mt-4" href="{{ route('categories.index') }}">
                            {{ __('Back to Categories') }}
                        </x-link-button>
                    </div>
                </form>
                @if($category->parent_id)
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-danger-button class="mt-4">
                            Delete the category
                        </x-danger-button>
                    </form>
                @endif
            </x-secondary-container>
        </x-main-container>
    </div>
</x-app-layout>
