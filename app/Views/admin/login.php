<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Medical Center Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Medical Center" name="description" />
  <meta content="Medical Center" name="author" />

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
  <div class="container">
    <div class="d-flex flex-column min-vh-100 px-3 pt-4">
      <div class="row justify-content-center my-auto">
        <div class="col-md-8 col-lg-6 col-xl-4">
          <div class="text-center py-5">
            <div class="user-thumb mb-4 mb-md-5">
              <img src="<?php echo base_url('assets/images/users/avatarLoginAdmin.png'); ?>" alt="Avatar" class="w-50">
              <h3 class=" mt-3">Welcome</h3>
            </div>
            <div class="form-floating form-floating-custom mb-3">
              <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
              <label for="password">Password</label>
              <div class="form-floating-icon">
                <i class="uil uil-padlock"></i>
              </div>
            </div>
            <div class="mt-3">
              <button type="button" class="btn btn-primary" id="btn-submit">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>
<script>
  $(document).ready(function() {

    // Obtener la URL actual
    var currentUrl = window.location.href;

    // Verificar si la URL contiene la palabra "msgErrorSession"
    if (currentUrl.includes('msgErrorSession')) {
      var toast = showToast('warning', 'Su session ha expirado');
    }

    $('#btn-submit').on('click', function() {

      let password = $('#password').val()

      if (password != '') {

        $.ajax({

          type: "post",
          url: "<?php echo base_url('Admin/login') ?>",
          data: {
            password: password
          },
          dataType: "json",

          success: function(jsonResponse) {
            if (jsonResponse.error == 0) 
                window.location.href = "<?php echo base_url('AdminActions/patientsReferrals'); ?>"  
            if (jsonResponse.error == 1) {
              $('#password').addClass('is-invalid');
              if (jsonResponse.code == 1) {
                showToast('error', 'Rectifique su contraseña');
              } else if (jsonResponse.code == 2) {
                showToast('error', 'Debe introducir la contraseña')
              }
            } 
            
          },

          error: function(error) {
            showToast('error', 'Ha ocurrido un error')
          }
        });

      } else {
        $('#password').addClass('is-invalid');
        showToast('error', 'Debe introducir la contraseña')
      }

    });

    $('#password').on('focus', function() {
      $(this).removeClass('is-invalid');
    });

  });
</script>