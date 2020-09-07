window.addEventListener('load', function() {

    // Slug field
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('keyup', '#en_name', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('admin.request.slug')}}",
            method: 'get',
            data: {
                en_name: $(this).val()
            },
            dataType: "json",
            success: function(result){
                $('#alias').val(result.slug);
                console.log(result.result);
            },
            done: function(result){
                console.log(result.result);
            },
            error: function(jqXHR, exception) {
                console.log(jqXHR);
                console.log(exception);
            }
        });
    });

});
