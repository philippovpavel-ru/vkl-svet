jQuery(document).ready(function ($) {
  const data = {
    action: 'admin_generate_pdf',
    post_id: generate_pdf_object.post_id,
    nonce: generate_pdf_object.nonce
  };

  const default_text_button = $('#download-pdf-link').text();

  $("#generate-pdf-link").on('click', function (e) {
    e.preventDefault();

    $.ajax({
      url: ajaxurl,
      method: 'POST',
      data: data,
      beforeSend: function (xhr) {
        $('.download-pdf-link-item').removeClass('active');
        $('#download-pdf-link').text('Загрузка');
        $('.download-pdf-link-item a').attr('href', '#');
      },
      success: function (res) {
        const response = JSON.parse(res);

        if (response.status) {
          $('#download-pdf-link').text(default_text_button);
          $('.download-pdf-link-item').addClass('active');
          $('.download-pdf-link-item a').attr('href', response.response);
        } else {
          $('#download-pdf-link').text('Что-то пошло не так, попробуйте позже');
        }
      },
      error: function () {
        $('#download-pdf-link').text('Что-то пошло не так, свяжитесь с администратором!');
      }
    });
  });
});