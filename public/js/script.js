$(function(){
    let $ajaxExecuting = false;
    $('input[name=post_code]').on('focusout', function(){
        let postCode = $(this).val();
        if(postCode.match(/^\d{7}$/)){
            $(this).val(postCode.substr(0, 3) + '-' + postCode.substr(3, 4));
        }

        let postCodeValue = $(this).val().replace('-', '');
        if(postCodeValue.match(/^\d{7}$/)){
            if (!$ajaxExecuting) {
                $.ajax({
                    url: 'https://zipcloud.ibsnet.co.jp/api/search',
                    dataType: 'jsonp',
                    data: {zipcode: postCodeValue},
                    beforeSend: function () {
                        $ajaxExecuting = true;
                    },
                    success: function (response) {
                        if (response.code === 200) {
                            $('select[name=prefecture] option').filter(function(index){
                                return ($(this).text()).trim() === response.data.pref;
                            }).prop('selected', true);
                            $('input[name=address_1]').val(response.data.address);
                        }
                    },
                    always: function () {
                        $ajaxExecuting = false;
                    }
                });
            }
        }
    });
    $('.ad-close').on('click', function(e) {
        e.preventDefault();
        $(this).closest('[data-ad]').addClass('hidden');
    });

    $('.table-body>tr>td:not(.actions)').on('click', function() {
        let tr = $(this).closest('tr');
        if (tr.hasClass('selected')) {
            tr.removeClass('selected');
        }else{
            tr.addClass('selected');
        }

        let exports = [];
        $('.table-body>tr.selected').each(function() {
            exports.push(tr.data('id'));
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

    $('#export-pdf').on('click', function(e){
        e.preventDefault();
        const valExports = $('input[name="exports"]').val();
        if(valExports === ''){
            alert('出力したいデータを選択してください。');
            return;
        }
        const arrExports = valExports.split(',');
        if (　arrExports.length >= 10){
            alert('PDF出力は10件が最大です。');
            return;
        }
        // 配列形式に変換
        let queryExports = '?exports[]=' + arrExports.join('&exports[]=');
        location.href = $(this).attr('href') + queryExports;
    });
})
