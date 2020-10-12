(function ($) {

    $(document).ready(function () {

        let $body = $('body');

        // Input file trigger click
        $body.on('click', '.images .pic', function () {
            let _this = $(this);
            _this.find('.file-uploader').get(0).click();
        });

        // Preview
        $body.on('change', '.file-uploader', function () {

            let _this = $(this);
            let isMultiple = $(this).attr('multiple');

            if (typeof isMultiple !== typeof undefined && isMultiple !== false) { // Multiple

                let counter = -1, file;

                if (!_this.hasClass('result_file_exist')) {
                    _this.closest('.images').find('.img').remove();
                }

                while (file = this.files[++counter]) {

                    let reader = new FileReader();
                    reader.onloadend = (function () {

                        return function() {
                            // _this.closest('.images').append('<div class="img" style="background-image: url(\'' + reader.result + '\');" rel="'+ reader.result  +'">' +
                            //                                     '<span class="remove-pic"><i class="fal fa-times"></i></span>' +
                            //                                 '</div>');
                            _this.closest('.images').append('<div class="img">' +
                                                                '<img src="'+reader.result+'" rel="'+ reader.result  +'">' +
                                                                '<span class="remove-pic"><i class="fal fa-times"></i></span>' +
                                                            '</div>');
                        };
                    })(file);

                    reader.readAsDataURL(file);
                }

            } else { // Single
                let reader = new FileReader();
                reader.onload = function(event) {
                    // _this.closest('.images').prepend('<div class="img" style="background-image: url(\'' + event.target.result + '\');" rel="'+ event.target.result  +'"><span class="remove-pic"><i class="fal fa-times"></i></span></div>');
                    _this.closest('.images').append('<div class="img">' +
                        '<img src="'+reader.result+'" rel="'+ reader.result  +'" />' +
                        '<span class="remove-pic"><i class="fal fa-times"></i></span>' +
                        '</div>');
                    _this.closest('.images').find('.pic').hide();
                }
                reader.readAsDataURL(_this.get(0).files[0]);
            }
        });

        // Remove selected
        $body.on('click', '.remove-pic', function () {
            let _this = $(this);
            let isMultiple = _this.closest('.images').find('.file-uploader').attr('multiple');

            if (_this.hasClass('result_file')) {

                let fileId = _this.attr('data-file-id');
                let url = $(this).attr('data-file-url');
                let title = $(this).attr('data-title');
                let confirmText = $(this).attr('data-confirm-text');
                let cancelText = $(this).attr('data-cancel-text');
                let isEditable = false;

                if ($('.img').hasClass('editable')) {
                    isEditable = true;
                }

                if (isEditable === true) {
                    $('.images').html($('<div class="pic">\n' +
                        '                                        <span style="font-size: 1.25rem;">Upload</span>\n' +
                        '                                        <input type="file" name="icon" accept="image/*" class="file-uploader d-none form-control @error(\'icon\') is-invalid @enderror" id="banner-image">\n' +
                        '                                    </div>'));

                    return false;
                }

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
                            type: "POST",
                            url: url,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {file_id: fileId},
                            dataType: 'json',
                            success: function (response) {

                                if (response.status === true) {

                                    Swal.fire(
                                        response.title,
                                        response.message,
                                        "success"
                                    );

                                    location.reload();
                                } else {
                                    Swal.fire(
                                        response.title,
                                        response.message,
                                        "error"
                                    );
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
                // Hide add more button for single image
                _this.closest('.images').find('.file-uploader').val(null);
                _this.closest('.images').find('.pic').show();
                _this.closest('.img').remove();
            }

        });

    });

})(jQuery);
