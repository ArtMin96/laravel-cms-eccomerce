$(document).ready(function() {

  $(document).on('click', '.remove-page', function (e) {
      e.preventDefault();

      let pageId = $(this).attr('data-page-id');
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
                  data: {id: pageId},
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
  });

    // Add new row
    $('body').on('click', '.add-new-row', function () {

        let firstRow = $(this).closest('form').find('.card:first');
        let clone = firstRow.clone(true);

        clone.find(':input:not([type=hidden])').val('');
        clone.addClass('mt-5');

        let rowCount = $(this).closest('form').find('.card').length + 1;

        clone.find('input').attr('id', function () {
            return $(this).attr('id') + '_' + (rowCount);
        });

        clone.find('.card-header-row-count').text(rowCount);

        clone.insertAfter($(this).closest('form').find('.card').last());

    });

});
