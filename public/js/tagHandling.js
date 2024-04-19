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
        $('#category-error').hide();
    }

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
            var tag = $('<span class="category-tag">' + item + '<button type="button" class="close-tag">&times;</button></span>');
            tag.find('.close-tag').click(function() {
                tag.remove();
                updateTagsDescription();
            });
            categoryTagsContainer.append(tag);
            updateTagsDescription();
            descriptionInput.val('').focus();
        }
    });

    form.on('submit', function(e) {
        if (hiddenDescription.val().trim() === '') {
            e.preventDefault();
            $('#category-error').show();
        }
    });
    updateTagsDescription();
});
