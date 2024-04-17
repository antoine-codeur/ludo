<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Post Information') }}
                            </h2>
                        </header>

                        <form method="post" action="{{ route('posts.store') }}" class="mt-6 space-y-6">
                            @csrf
                            
                            <!-- Title Field -->
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Content Field -->
                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <textarea id="content" name="content" class="mt-1 block w-full" rows="6" required>{{ old('content') }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <!-- Image Upload Field -->
                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                <small class="text-gray-500">Max file size: 2MB</small>
                            </div>
                            
                            <!-- Description Field -->
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="mt-1 block w-full" rows="4" required>{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            
                            
                            <!-- Submit Button -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Create') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
