<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Category Information') }}
                            </h2>
                        </header>

                        <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            
                            <!-- Name Field -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Description Field -->
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="mt-1 block w-full" rows="4">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- Image Upload Field -->
                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                <small class="text-gray-500">Max file size: 2MB</small>
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