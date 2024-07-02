<script>
    $(function(){
        $('input[name=post_code]').on('focusout', function(){
            let postCode = $(this).val();
                postCode = postCode.slice(0, 3) + '-' + postCode.slice(3);
                $(this).val(postCode);
        });
    })
</script>
