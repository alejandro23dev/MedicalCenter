<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Making Memories Home Health Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Making Memories Home Health" name="description" />
  <meta content="Making Memories Home Health" name="author" />

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/medical/favicon.png'); ?>">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/libs/sweetalert/sweetalert2.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />

  <script src="<?php echo base_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/libs/metismenujs/metismenujs.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/libs/simplebar/simplebar.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/libs/feather-icons/feather.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/libs/sweetalert/sweetalert2.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/customApp.js'); ?>"></script>
</head>

<body>

  <div id="layout-wrapper">
    <div id="main-modal"></div>
    <div class="m-3">
      <?php echo view('navBars/navBarAdmin'); ?>
    </div>
    <?php echo view($page); ?>
  </div>

  <div class="d-block bg-primary text-center btn-rounded m-5 shadow-lg aFloatCenter">
    <a id="messages" class="nav-link fs-3p-3 ms-2 me-2 text-white" href="<?php echo base_url('AdminActions/messages'); ?>"><i class="mdi mdi-message-alert-outline fs-1"></i></a>
  </div>

  <div class="d-block bg-primary text-center btn-rounded m-5 shadow-lg aFloatLeft">
    <a id="patientReferral" class="nav-link fs-3p-3 ms-2 me-2 text-white" href="<?php echo base_url('AdminActions/patientsReferrals'); ?>"><i class="mdi mdi-home fs-1"></i></a>
  </div>

  <div class="d-block bg-primary text-center btn-rounded m-5 shadow-lg aFloatRight">
    <a id="chatOnline" class="nav-link fs-3p-3 ms-2 me-2 text-white" href="#"><i class="mdi mdi-chat fs-1"></i></a>
  </div>
</body>

</html>

<style>
  .cursorPointer {
    cursor: pointer;
  }

  .aFloatRight {
    position: fixed;
    bottom: 0;
    right: 0;
  }

  .aFloatLeft {
    position: fixed;
    bottom: 0;
    left: 0;
  }

  .aFloatCenter {
    position: fixed;
    bottom: 0;
    left: 15%;
  }
</style>

<script>
  $('#chatOnline').on('click', function() {


    $.ajax({

      type: "post",
      url: "<?php echo base_url('AdminActions/showModalChatOnline'); ?>",
      dataType: "html",
      success: function(htmlResponse) {
        $('#main-modal').html(htmlResponse);
        $('#chatModal').modal('show');
      },
      error: function(error) {
        showToast('error', 'Ha ocurrido un error');
      }
    });
  });

  $('#btn-changeKey').click(function(e) {

    e.preventDefault();

    $.ajax({
      type: "post",
      url: "<?php echo base_url('AdminActions/showModalChangeKey'); ?>",
      dataType: "html",
      success: function(htmlResponse) {
        $('#main-modal').html(htmlResponse);
      },
      error: function(error) {
        showToast('error', 'Ha ocurrido un error');
      }
    });

  });
</script>