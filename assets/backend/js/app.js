import 'babel-polyfill';
import './shim-semantic-ui';

import 'sylius/ui/js/app';
import 'sylius/ui/js/sylius-auto-complete';

import './slug';
import './app-date-time-picker';
import './app-images-preview';
import './sylius-compound-form-errors';

import '../scss/main.scss';

$(document).ready(function () {
    $(document).previewUploadedImage('#sylius_admin_user_avatar');

    // Use this previewer for files uploads
    // $(document).previewUploadedFile('#app_book_file');

    $('.sylius-autocomplete').autoComplete();
    $('.sylius-tabular-form').addTabErrors();
    $('.ui.accordion').addAccordionErrors();
    $('#sylius_customer_createUser').change(function () {
        $('#user-form').toggle();
    });

    $('.app-date-picker').datePicker();
    $('.app-date-time-picker').dateTimePicker();
});
