require('./bootstrap');

require('admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll');
require('admin-lte/bower_components/fastclick/lib/fastclick');
require('select2/dist/js/select2.full');
require('icheck/icheck');
require('admin-lte');

require('./vue');

$(function () {
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-orange, input[type="radio"].flat-orange').iCheck({
        checkboxClass: 'icheckbox_flat-orange',
        radioClass   : 'iradio_flat-orange'
    });

    //Initialize Select2 Elements
    $('select.select2').select2();

    $('*[data-href]').on("click", function() {
        document.location = $(this).data('href');
    });
});
