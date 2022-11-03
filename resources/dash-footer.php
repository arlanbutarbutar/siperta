<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © <?= date('Y') ?> <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com', '_blank')">Netmedia Framecode</a> . All rights reserved.</span>
  </div>
</footer>
</div>
</div>
</div>
<script src="../assets/js/vendor.bundle.base.js"></script>
<script src="../assets/js/Chart.min.js"></script>
<script src="../assets/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/progressbar.min.js"></script>
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/template.js"></script>
<script src="../assets/js/settings.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="../assets/js/jquery.cookie.js"></script>
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/Chart.roundedBarCharts.js"></script>
<script src="../assets/js/jquery-3.5.1.min.js"></script>
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
<script>
  $(document).ready(function() {
    $('#search-all').on('keyup', function() {
      $.get('search.php?key=' + $('#search-all').val(), function(data) {
        $('#search-page').html(data);
      });
    });
  });
</script>