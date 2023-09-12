<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatModalLabel">Chat of the Questions</h5>
        <button type="button" class="btn btn-close" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
        <?php if (empty($messages)) : ?>
          <p class="text-center text-muted">Not messages</p>
        <?php endif; ?>
        <?php
        $messageGroups = array_chunk($messages, 5);
        // Ordenar los mensajes por el ID en orden descendente
        usort($messages, function ($a, $b) {
          return $a->id - $b->id;
        }); ?>
        <?php foreach ($messageGroups as $group) : ?>
          <div class="message-group">
            <?php foreach ($group as $message) : ?>
              <?php if ($message->role == 2) : ?>
                <div class="bg-soft-secondary p-2 col-6 rounded mt-3" id="<?php echo $message->id ?>">
                  <h3 class="fw-bold"><i class="mdi mdi-account"></i><?php echo $message->user ?></h3>
                  <p><?php echo $message->message ?></p>
                  <div class="bg-primary p-3 rounded">
                    <h5 class="text-white"><i class="mdi mdi-account-check"></i>Admin</h5>
                    <p class="text-white"><?php echo $message->response ?></p>
                  </div>
                </div>
                <div class="text-muted fs-6">
                  <p><?php echo $message->date ?></p>
                </div>
              <?php elseif ($message->role == 1) : ?>
                <div class="bg-primary me-0 p-2 rounded mt-3 col-6 text-end justify-content-end" style="margin-left: 50%;" id="<?php echo $message->id ?>">
                  <h3 class="text-white"><?php echo $message->user ?> <i class="mdi mdi-account-check"></i></h3>
                  <p class="text-white"><?php echo $message->message ?></p>
                </div>
                <div class="text-muted fs-6 text-end">
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
        <button type="button" id="btn-send" class="btn btn-primary col-1 fs-6 p-2"><i class="bi bi-send-fill"></i></button>

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
      let role = "<?php echo $role; ?>";
      let user = "<?php echo $user; ?>";

      $.ajax({
        type: "post",
        url: "<?php echo base_url('Home/sendMessages') ?>",
        data: {
          role: role,
          user: user,
          message: $('#message').val()
        },
        dataType: "json",
        success: function(jsonResponse) {
          if (jsonResponse.error == 0) {
            showToast('success', 'Message sent for review')
            $('#chatModal').modal('hide');
          } else if (jsonResponse.error == 1)
            showToast('error', 'Message not sent')
          else if (jsonResponse.error == 2) {
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