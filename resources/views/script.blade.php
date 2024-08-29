<script type="module">
    $(function(){
        $('input[name=post_code]').on('focusout', function(){
            let postCode = $(this).val();
            if(postCode.match(/^\d{7}$/)){
                $(this).val(postCode.substr(0, 3) + '-' + postCode.substr(3, 4));
            }

        });
        $('.ad-close').on('click', function(e) {
            e.preventDefault();
            $(this).closest('[data-ad]').addClass('hidden');
        });
    })
</script>
