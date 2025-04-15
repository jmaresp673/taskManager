<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>


    <div class="py-6">
        <x-main-container>
            <div x-data="{ showModal: false }">
                <div class="w-full flex justify-end">
                    <x-secondary-button class="mb-4 bg-blue-500 text-white px-4 py-2 rounded" @click="showModal = true">
                        New Category
                    </x-secondary-button>
                </div>

                <!-- Modal -->
                <div x-show="showModal"
                     class="z-50 fixed inset-0 flex items-center justify-center bg-opacity-50 bg-gray-900">
                    <x-main-container class="w-1/2">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                            <x-text class="text-lg font-bold mb-4">
                                Create New Category
                            </x-text>
                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Name')"/>
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required
                                                  autofocus/>
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="description" :value="__('Description')"/>
                                    <x-text-input id="description" class="block mt-1 w-full" type="text"
                                                  name="description" required/>
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="color_code" :value="__('Color Code')"/>
                                    <input type="color" id="color" class="block mt-1" name="color_code" value="#ff0000"
                                           required>
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="parent_id" :value="__('Parent Category')"/>
                                    <x-input-select id="parent_id" name="parent_id" class="block mt-1 w-full">
                                        <option value="">None</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </x-input-select>
                                </div>

                                <x-primary-button class="mt-4">
                                    {{ __('Create') }}
                                </x-primary-button>
                                <x-secondary-button @click="showModal = false">
                                    Close
                                </x-secondary-button>
                            </form>
                        </div>
                    </x-main-container>
                </div>
            </div>


            {{-- List categories (Drag & Drop implementacion) --}}
            <ul id="categories-list" class="space-y-2">
                <div
                    class="pr-3 pl-8 py-3 flex flex-row justify-between rounded cursor-grab bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
                    <x-text class="font-bold pl-10 w-[30%] text-xl ">
                        Name
                    </x-text>
                    <x-text class="font-bold w-full text-xl">
                        Description
                    </x-text>
                    <div class="inline-flex w-[30%]">
                        <x-text class="font-bold text-xl">
                            Created
                        </x-text>
                        <x-text class="font-bold text-xl">
                            subcategories
                        </x-text>
                    </div>
                    <x-text class="font-bold text-center text-xl w-1/3">
                        Actions
                    </x-text>
                </div>
                @foreach ($categories as $category)
                    <li class="pr-3 pl-10 flex flex-row justify-between rounded cursor-grab bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                        data-id="{{ $category->id }}">
                        <x-text
                            class="flex flex-row justify-start items-center !p-0 pr-6 font-bold w-[30%] text-[{{ $category->color_code }}]">
                            <div class="rounded-full mr-4 w-4 h-4 bg-[{{ $category->color_code }}]"></div>
                            {{ $category->name }}
                        </x-text>

                        <x-text class="text-left w-full flex items-center">
                            {{ $category->description }}
                        </x-text>

                        <x-text class="font-light text-nowrap w-[30%] flex items-center">
                            {{ $category->created_at->diffForHumans() }}
                        </x-text>

                        {{-- subcategories dropdown --}}
                        @if ($category->children->isNotEmpty())
                            <button class="text-sm text-blue-500 ml-2 w-[10%]"
                                    onclick="toggleSubcategories({{ $category->id }})">
                                <x-text>▼</x-text>
                            </button>

                            <ul id="subcategories-{{ $category->id }}" class="hidden ml-6 mt-2">
                                @foreach ($category->children as $sub)
                                    <li class="bg-gray-200 p-2 rounded mt-1 mb-3 cursor-pointer relative"
                                        data-id="{{ $sub->id }}"
                                        onclick="window.location='{{ route('categories.edit', $sub->id) }}'">
                                        {{ $sub->name }}
                                        <div class="absolute left-0 top-0 h-full w-1 rounded-l"
                                             style="background-color: {{ $sub->color_code }};"></div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="flex flex-col justify-center items-center p-3 w-1/3 ">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>
                                    Delete
                                </x-danger-button>
                            </form>
                            <x-link-button class="mt-2" href="{{ route('categories.edit', $category->id) }}">
                                {{__('Edit')}}
                            </x-link-button>
                        </div>
                    </li>
                @endforeach
            </ul>

        </x-main-container>
    </div>


    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // drag & drop
        new Sortable(document.getElementById('categories-list'), {
            animation: 150,
            onEnd: function (evt) {
                let ids = [...document.querySelectorAll('#categories-list li')].map(el => el.dataset.id);
                fetch("{{ route('categories.reorder') }}", {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    body: JSON.stringify({order: ids})
                });
            }
        });

        // toggle subcategories
        function toggleSubcategories(id) {
            let subList = document.getElementById('subcategories-' + id);
            subList.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
