<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/tagHandling.css') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
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

                        <form method="post" action="{{ route('posts.update', $post->id) }}">
                            @csrf
                            @method('PUT') <!-- Important pour la méthode HTTP PUT -->

                            <!-- Title Field -->
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ $post->title }}" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Content Field -->
                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <textarea id="content" name="content" class="mt-1 block w-full" rows="6" required>{{ $post->content }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <!-- Image Upload Field -->
                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                <small class="text-gray-500">Max file size: 2MB</small>
                            </div>
                            <!-- Tags et description déjà existants peuvent être gérés ici -->
                            <div id="category-tags" class="mb-4"></div>

                            <!-- Description Field -->
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="old-description" name="old-description" class="mt-1 block w-full" rows="4">{{ $post->description }}</textarea>
                                <input type="hidden" id="description" name="description">
                                <div id="category-error" class="text-red-500 mt-2" style="display: none;">Please add at least one category.</div>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
    var descriptionInput = $('#old-description');
    var categoryTagsContainer = $('#category-tags');
    var hiddenDescription = $('#description');  
    var form = $('form');

    // Fonction pour mettre à jour la description cachée
    function updateTagsDescription() {
        var tags = [];
        $('.category-tag').each(function() {
            tags.push($(this).text().trim().slice(0, -1)); // Enlève le 'x'
        });
        hiddenDescription.val(tags.join(' '));
        $('#category-error').hide();
    }

    // Initialisation des tags à partir de la description actuelle
    function initializeTags() {
        var existingTags = descriptionInput.val().split(' ');
        existingTags.forEach(function(tag) {
            if (tag.trim() !== '') {
                createTag('#' + tag.trim());
            }
        });
        descriptionInput.val(''); // Vide le textarea après l'initialisation
    }

    // Fonction pour créer un tag visuellement
    function createTag(text) {
        var tag = $('<span class="category-tag">' + text + '<button type="button" class="close-tag">&times;</button></span>');
        tag.find('.close-tag').click(function() {
            $(this).parent().remove();
            updateTagsDescription();
        });
        categoryTagsContainer.append(tag);
        updateTagsDescription();
    }

    // Configuration de Typeahead pour ajouter de nouveaux tags
    descriptionInput.typeahead({
        minLength: 1,
        source: function(query, process) {
            var lastIndex = query.lastIndexOf("#");
            var searchTerm = query.substr(lastIndex + 1).trim();

            if (searchTerm.length > 0) {
                $.get(autocompleteUrl, { term: searchTerm }, function(data) {
                    process(data.map(category => '#' + category));
                });
            }
        },
        afterSelect: function(item) {
            createTag(item);
            descriptionInput.val(''); // Vide le textarea après chaque ajout de tag
        }
    });

    // Validation avant soumission du formulaire
    form.on('submit', function(e) {
        if (hiddenDescription.val().trim() === '') {
            e.preventDefault();
            $('#category-error').show();
        }
    });

    // Appel initial pour configurer les tags existants
    initializeTags();
});


</script>
<script type="text/javascript">
    var autocompleteUrl = "{{ route('autocomplete.categories') }}";
</script>
<script src="{{ asset('js/tagHandling.js') }}"></script>
