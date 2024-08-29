<script type="module">

    let tagsContainer;

    $(document).ready(function() {
        tagsContainer = $('[data-tags-container="tags"]');
        let currentTags = tagsContainer.find('input[name="tags"]');
        if(currentTags.val().trim() !== '') {
            setTags(tagsContainer, currentTags.val().trim());
        }
    });

    $('input[name="tags"]').on('change', function(e){
        setTags(tagsContainer, $(this).val().trim());
    });

    function setTags(tagsContainer, tagsValue) {
        let separator = ' ';
        let tagItems = tagsContainer.find('[data-tags="tags"]');
        let tagsVal = tagsValue;

        $('.tags-items').remove();

        if (tagsVal) {
            tagsVal.split(separator).forEach(tag => {
                if (!tag.trim()) return;
                let tagElement = $('<span></span>')
                    .text(tag)
                    .addClass('tags-items bg-custom-light-gray text-black p-2 rounded');
                tagItems.append(tagElement);
            });
        }
    }

</script>
