$(document).ready(function () {
    $('#content .card .card-body #product_cat select').change(function () {
        var product_cat_id = $(this).val();
        var data = { product_cat_id: product_cat_id }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           'url': "admin/ajax/product_category",
            'method': 'post',
            'data': data,
            // 'dataType': 'text',
            success: function (data) {
                $('#content .card .card-body #product_sub_cat select').html(data)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status)
                alert(thrownError)
            }

        })
    })
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function () {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function () {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });
});