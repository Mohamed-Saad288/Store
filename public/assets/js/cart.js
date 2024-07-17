(function($) {
    $('.item-quantity').on('change', function(e) {
        $.ajax({
            url: "/cart/" + $(this).data('id'),
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            },
            success: function(response) {
                console.log('Success:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
})(jQuery);

