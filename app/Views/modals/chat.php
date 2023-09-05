<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatModalLabel">Chat Online</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php foreach ($messages as $message) : ?>
          <div class="bg-soft-secondary p-2 col-4 rounded mt-3">
            <h3><?php echo $message->user ?></h3>
            <p><?php echo $message->message ?></p>
            <p><?php echo $message->date ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="modal-footer">
        <input type="text" id="message" class="modal-required focus col-10" placeholder="Type you message here...">
        <button type="button" id="btn-send" class="btn btn-primary col-1">Send</button>
      </div>
    </div>
  </div>
</div>

<?php echo view('global/formValidation'); ?>

<script>
  $(document).ready(function() {

    $.ajax({
      type: "get",
      url: "<?php echo base_url('Home/getMessages') ?>",
      dataType: "json",
      success: function (response) {
      }
    });
    
    $('#btn-send').click(function() {
      
      let resultCheckRequiredValues = checkRequiredValues('modal-required');
      
      
        console.log('click');
        $.ajax({
          type: "post",
          url: "<?php echo base_url('Home/sendMessages') ?>",
          data: {
            message: $('#message').val()
          },
          dataType: "json",
          success: function(jsonResponse) {
            if (jsonResponse.error == 0) {
              showToast('success', 'Message sent')
              $('#chatModal .modal-body').load("<?php echo base_url('Home/getMessages') ?>");
              $('#message').val('');
            } else if (jsonResponse.error == 1)
              showToast('error', 'Message not sent')
            else if (jsonResponse.error == 2) {
              showToast('error', 'Empty Message')
              $('#message').addClass('is-invalid');
            }
          }
        });
      
    });

  });
  $('.close').on('click', function() { // ON CLOSE

    $('#chatModal').modal('hide');
    $('#main-modal').html('');

  });

  function closeModal() {

    $('#chatModal').modal('hide');
    $('#main-modal').html('');

  }
</script>