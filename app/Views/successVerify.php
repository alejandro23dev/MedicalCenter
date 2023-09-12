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


<div class="container">
  <div class="d-flex flex-column min-vh-100 px-3 pt-4">
    <div class="row justify-content-center my-auto">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="text-center py-5">
          <div class="">
            <div class="spinner-border text-primary fs-3" role="status">
            </div>
            <p class="text-muted fst-italic fs-4">We are sending your information to the system</p>
          </div>
        </div>
      </div>
    </div>
  </div>
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
        window.location.href = "<?php echo base_url('Home/patientReferral'); ?>?=msgErrorVerify";
    }
  });
</script>