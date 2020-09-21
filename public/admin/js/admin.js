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

    $('body').on('click', '.js--add-new-phone-row', function () {

        let _this = $(this);
        let clone = _this.closest('.card-body').find('.phone-number-field-group:first').clone(true);

        clone.find('.js--remove-new-phone-row').removeClass('d-none').removeClass('remove-phone-input');
        clone.find('.custom-radio').remove();

        let rowCount = _this.closest('.card-body').find('.phone-number-field-group').length + 1;

        clone.find('input').attr('id', function () {
            return $(this).attr('id') + '_' + (rowCount);
        });

        clone.insertAfter(_this.closest('.card-body').find('.phone-number-field-group').last());
        clone.find('input').attr('value', '');

    });

    $('body').on('click', '.js--remove-new-phone-row', function () {
        if ($(this).hasClass('remove-phone-input')) {
            let id = $(this).attr('data-id');
            let url = $(this).attr('data-url');
            let title = $(this).attr('data-title');
            let confirmText = $(this).attr('data-confirm-text');
            let cancelText = $(this).attr('data-cancel-text');

            Swal.fire({
                title: title,
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: confirmText,
                cancelButtonText: cancelText,
                buttonsStyling: true,
                // customClass: {
                //     confirmButton: 'btn-sm'
                // },
                onBeforeOpen: function(ele) {
                    $(ele).find('button.swal2-confirm.swal2-styled').toggleClass('swal2-confirm swal2-styled swal2-confirm btn btn-md btn-primary');
                    $(ele).find('button.swal2-cancel.swal2-styled').toggleClass('swal2-cancel swal2-styled btn btn-md btn-light ml-3');
                }
            }).then(function (e) {

                if (e.value === true) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id: id},
                        success: function (response) {
                            if (response.status == true) {
                                window.location.reload();
                            }
                        },
                        failure: function (response) {
                            Swal.fire(
                                "Internal Error",
                                "Oops, your note was not saved.", // had a missing comma
                                "error"
                            )
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            });
        } else {
            $(this).closest('.phone-number-field-group').remove();
        }
    });

    $('body').on('keyup', '.phone-input', function () {
        console.log($(this));
    });

});
