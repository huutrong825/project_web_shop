$(document).ready(function (){
    $('.modal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        var vali = $(this).find('form').validate();
        vali.resetForm();
    })
});