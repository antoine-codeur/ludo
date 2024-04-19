$(document).ready(function() {
    var descriptionInput = $('#old-description');
    var categoryTagsContainer = $('#category-tags');
    var hiddenDescription = $('#description');
    var form = $('form');

    function updateTagsDescription() {
        var tags = [];
        $('.category-tag').each(function() {
            tags.push($(this).text().trim().slice(0, -1));
        });
        hiddenDescription.val(tags.join(' '));
    }

    function addTag(tagText) {
        var tag = $('<span class="category-tag">' + tagText + '<button type="button" class="close-tag">&times;</button></span>');
        tag.find('.close-tag').click(function() {
            tag.remove();
            updateTagsDescription();
        });
        categoryTagsContainer.append(tag);
        updateTagsDescription();
        descriptionInput.val('');
    }

    descriptionInput.typeahead({
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
            addTag(item);
        }
    });

    descriptionInput.on('keyup', function(e) {
        var key = e.key;
        var inputValue = $(this).val().trim();
        if (inputValue && (key === 'Enter' || key === ' ' || key === 'Tab')) {
            e.preventDefault(); // Prevent default action of the key
            addTag('#' + inputValue);
        }
    });

    form.on('submit', function(e) {
        if (hiddenDescription.val().trim() === '') {
            e.preventDefault();
            $('#category-error').show();
        }
    });

    updateTagsDescription(); // Update on load
});
