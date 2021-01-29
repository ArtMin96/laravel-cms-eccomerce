$(document).ready(function () {

    let $body = $('body');

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
