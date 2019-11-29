$(function () {
    $('#select').find("[value='" + $.cookie("number_records") + "']").prop('selected', 'selected');
});
$('#select').change(function() {
    $.cookie('number_records', $(this).val(),{ path: window.location.pathname, expires: 7} );
    location.reload();
});