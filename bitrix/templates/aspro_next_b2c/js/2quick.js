$(document).on('click', '.tqGeneratePDF', function () {
    var $this = $(this);
    var action = $this.attr('data-action');
    var data = {action: action};
    switch (action) {
        case 'product':
            data['ID'] = $this.attr('data-id');
            break;
        case 'add2basket':
            data['ID'] = $this.attr('data-id');
            break;
    }


    $.ajax({
        url: "/bitrix/templates/aspro_next_b2c/ajax/2quick.php",
        type: "POST",
        data: data,
        success: function (result) {

            $.ajax({
                url: "/bitrix/templates/aspro_next_b2c/ajax/2quick.php",
                type: "POST",
                data: {action: 'getFileUrl'},
                dataType: 'json',
                success: function (fileResult) {
                    console.log(fileResult);
                    window.open(fileResult.LINK, '_blank');
                },
            });
        }
    });
    return false;
});
$(document).on('click', '.tqChangeAction', function () {
    var action = $(this).attr('data-action');
    $('.tqBasketLink').attr('data-action', action);
});