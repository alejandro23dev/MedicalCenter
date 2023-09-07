<div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="responseModalLabel">Chat Online</h5>
        <button type="button" class="btn btn-close" aria-label="Close">

        </button>
      </div>
      <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
        <div class="message-group">
          <div class="bg-soft-secondary p-2 col-6 rounded mt-3" style="max-width: 50%;" id="<?php echo $messages[0]->id ?>">
            <h3><?php echo $messages[0]->user ?></h3>
            <p><?php echo $messages[0]->message ?></p>
          </div>
          <div class="text-muted fs-6">
            <p><?php echo $messages[0]->date ?></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class=" col-10">
          <input type="text" id="response" class="form-control chatModal-required focus" placeholder="Type you response here...">
        </div>
        <button type="button" id="btn-send" class="btn btn-primary col-1 fs-6 p-2"><i class="bi bi-send-fill"></i></button>

      </div>
    </div>
  </div>
</div>

<?php echo view('global/formValidation'); ?>

<script>
  $(document).ready(function() {

    $('#btn-send').on('click keydown', function(event) {
      if (event.type === 'click' || event.keyCode === 13) {

        let resultCheckRequiredValues = checkRequiredValues('chatModal-required');

        $.ajax({
          type: "post",
          url: "<?php echo base_url('AdminActions/respondMessage') ?>",
          data: {
            id: $('#responseMsg').attr('data-id'),
            response: $('#response').val(),
          },
          dataType: "json",
          success: function(jsonResponse) {
            if (jsonResponse.error == 0) {
              showToast('success', 'Success');
              $('#responseModal').modal('hide');
            } else if (jsonResponse.error == 1)
              showToast('error', 'Error');
          }
        });
      }
    });

  });
  $('.btn-close').on('click', function() { // ON CLOSE

    $('#responseModal').modal('hide');
    $('#main-modal').html('');

  });

  function closeModal() {

    $('#responseModal').modal('hide');
    $('#main-modal').html('');

  }
</script>