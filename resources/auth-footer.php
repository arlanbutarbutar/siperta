<script src="<?= $baseURL; ?>assets/js/vendor.bundle.base.js"></script>
<script src="<?= $baseURL; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?= $baseURL; ?>assets/js/off-canvas.js"></script>
<script src="<?= $baseURL; ?>assets/js/hoverable-collapse.js"></script>
<script src="<?= $baseURL; ?>assets/js/template.js"></script>
<script src="<?= $baseURL; ?>assets/js/settings.js"></script>
<script src="<?= $baseURL; ?>assets/js/todolist.js"></script>
<script src="<?= $baseURL; ?>assets/js/jquery-3.5.1.min.js"></script>
<script>
  const messageSuccess = $('.message-success').data('message-success');
  const messageInfo = $('.message-info').data('message-info');
  const messageWarning = $('.message-warning').data('message-warning');
  const messageDanger = $('.message-danger').data('message-danger');

  if (messageSuccess) {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil Terkirim',
      text: messageSuccess,
    })
  }

  if (messageInfo) {
    Swal.fire({
      icon: 'info',
      title: 'For your information',
      text: messageInfo,
    })
  }
  if (messageWarning) {
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan!!',
      text: messageWarning,
    })
  }
  if (messageDanger) {
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan',
      text: messageDanger,
    })
  }
</script>