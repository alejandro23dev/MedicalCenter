<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatModalLabel">Chat Online</h5>
        <button type="button" class="btn btn-close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
      <?php if(empty($messages)):?>
        <p class="text-center text-muted">Not messages</p>
        <?php endif;?>
        <?php
        $messageGroups = array_chunk($messages, 3);
        // Ordenar los mensajes por el ID en orden descendente
        usort($messages, function ($a, $b) {
          return $a->id - $b->id;
        }); ?>
        <?php foreach ($messageGroups as $group) : ?>
          <div class="message-group">
            <?php foreach ($group as $message) : ?>
              <?php if ($message->role == 2) : ?>
                <div class="bg-soft-secondary p-2 col-md-6 rounded mt-3">
                  <h3><?php echo $message->user ?></h3>
                  <p><?php echo $message->message ?></p>
                  <p><?php echo $message->date ?></p>
                </div>
              <?php elseif ($message->role == 1) : ?>
                <div class="bg-soft-primary me-0 p-2 me-0 col-md-6 rounded mt-3 text-end">
                  <h3><?php echo $message->user ?></h3>
                  <p><?php echo $message->message ?></p>
                  <p><?php echo $message->date ?></p>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="modal-footer">
        <div class=" col-10">
          <input type="text" id="message" class="form-control chatModal-required focus" placeholder="Type you message here...">
        </div>
        <button type="button" id="btn-send" class="btn btn-primary col-1 fs-4"><i class="bi bi-send-fill"></i></button>

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
      success: function(response) {}
    });

    $('#btn-send').click(function() {

      let resultCheckRequiredValues = checkRequiredValues('chatModal-required');

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
            $('#message').val('');
            $('#chatModal').modal('hide');
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
  $('.btn-close').on('click', function() { // ON CLOSE

    $('#chatModal').modal('hide');
    $('#main-modal').html('');

  });

  function closeModal() {

    $('#chatModal').modal('hide');
    $('#main-modal').html('');

  }
</script>