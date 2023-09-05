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

<div class="row m-0 vh-100 justify-content-center">
<div class="spinner-border text-primary" role="status">
</div> 
<span class="text-muted fst-italic">Sending Patient Referral</span>
</div>
<script>
  var id = "<?php echo $id; ?>";

  $.ajax({
    type: "post",
    url: "<?php echo base_url('Home/sendInfo') ?>",
    data: {
      id: id
    },
    dataType: "json",
    success: function(jsonResponse) {
      if (jsonResponse.error == 0) { // ÉXITO
          window.location.href = "<?php echo base_url('Home'); ?>?=msgSuccessVerify";
      } else if (jsonResponse.error == 1) // ERROR
        showToast('error', 'Patient Referral could not be sent');
    }
  });
</script>
