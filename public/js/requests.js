$(document).ready(function () {

    let $body = $('body');

    // Add to wishlist
    $body.on('click', '.equipment-wish-btn', function (e) {
        e.preventDefault(e);

        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');

        $.ajax({
            type: "POST",
            url: url,
            data: {id: id, _token: $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success: function(response) {
                $(this).find('i').toggleClass('far fas');
                messageDialog(response.message);
            },
            error: function(data) {
            }
        })
    });

    /**
     * show message dialog alert
     */
    function messageDialog(messageText){
        $(`
            <div class="message-dialog g-card-wrap">
                <span>${messageText}</span>
            </div>
        `).appendTo('body').slideToggle('slow');

        setTimeout(()=>{
            $('.message-dialog').fadeOut('slow', function(){ $(this).remove(); });
        }, 4000);
    }

});
