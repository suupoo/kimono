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

    $('.table-body>tr').on('click', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }else{
            $(this).addClass('selected');
        }

        let exports = [];
        $('.table-body>tr.selected').each(function() {
            exports.push($(this).data('id'));
        });
        $('input[name="exports"]').val(exports);
    });

    $('#select-all').on('click', function() {
        $('.table-body>tr').addClass('selected');
        let exports = [];
        $('.table-body>tr.selected').each(function() {
            exports.push($(this).data('id'));
        });
        $('input[name="exports"]').val(exports);
    });

    $('#export-csv').on('click', function(e){
        e.preventDefault();
        let valExports = $('input[name="exports"]').val();
        if(valExports === ''){
            alert('出力したいデータを選択してください。');
            return;
        }
        // 配列形式に変換
        let queryExports = '?exports[]=' + valExports.split(',').join('&exports[]=');
        location.href = $(this).attr('href') + queryExports;
    });
})
