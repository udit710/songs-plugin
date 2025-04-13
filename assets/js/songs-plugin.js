/**
 * Songs Plugin JavaScript
 * Handles the AJAX form submission for the Songs Plugin.
 */
(function($){

    $(document).ready(function(){

        $('#songs-form__form').submit(function(event){
            event.preventDefault();

            var form = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: spData.rest_url,
                headers: { 'X-WP-Nonce': spData.nonce },
                data: form,
                success: function(response) {
                    $('#songs-form__form').prepend('<div class="alert alert-success">'+response+'</div>');
                },
                error: function(xhr) {
                    console.log(xhr);
                    $('#songs-form__form').prepend('<div class="alert alert-danger"><h3>Error: '+xhr.responseJSON.data.status+'</h3><br />'+xhr.responseJSON.message+'</div>');
                }
            });

        });

    });

})(jQuery);