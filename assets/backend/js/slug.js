$(document).ready(function () {
    const $name = $('#book_name');
    const $slug = $('#book_slug');

    $name.keyup(function () {
        const name = $(this).val();
        const url = $slug.data('url').replace('__name__', name);
        console.debug('url', url);

        $.get(url, function( data ) {
            $slug.val( data.slug );
        });
    });
});