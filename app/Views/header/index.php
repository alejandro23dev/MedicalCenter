<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Medical Center</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Medical Center" name="description" />
  <meta content="Medical Center" name="author" />

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/medical/favicon.png'); ?>">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/libs/sweetalert/sweetalert2.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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
    <div class="d-inline-flex align-items-center text-center">
      <img src="<?php echo base_url('assets/images/medical/Logo_BlueHeart (1).png'); ?>" alt="Image" class="w-25">
      <p class="fs-5 ms-5 fst-italic">Contact Us: <a href="tel:877-233-233-233"><i class="mdi mdi-phone"></i> 877-233-233-233</a> <a href="mailto:'example@gmail.com'"><i class="mdi mdi-email"></i> makingMemories@gmail.com</a>
      <p class="ms-4 text-muted fs-5 cursorPointer" onclick="openMaps()">
        <i class="mdi mdi-map-marker"></i>
        7827 N Dale Mabry Hwy suite 212,
        Tampa, FL 33614
      </p>
      </p>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #005081;">
    <div class="container-fluid">
      <i class="navbar-toggler bi bi-list align-items-end text-white" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav w-100 d-flex justify-content-between m-3">
          <li class="nav-item">
            <a id="Home" class="nav-link text-white fs-3 modern-title " href="<?php echo base_url('Home'); ?>">ABOUT US</a>
          <li class="nav-item">
            <a id="missionAndPhilosophy" class="nav-link text-white fs-3 modern-title " href="<?php echo base_url('Home/missionAndPhilosophy'); ?>">Mission and Philosophy</a>
          </li>
          <li class="nav-item">
            <a id="services" class="nav-link text-white fs-3 modern-title " href="<?php echo base_url('Home/services'); ?>">Services</a>
          </li>
          <li class="nav-item">
            <a id="patientReferral" class="nav-link text-white  fs-3 modern-title " href="<?php echo base_url('Home/patientReferral'); ?>">Patient Referral</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php echo view($page); ?>
  <div class="d-block text-center btn-rounded m-5 bg-white shadow-lg aFloat">
    <a id="chatOnline" class="nav-link fs-3 modern-title p-3 ms-2 me-2 " style="color: #005081;" href="#"><i class="mdi mdi-chat fs-1"></i></a>
  </div>

</body>
<style>
  .cursorPointer {
    cursor: pointer;
  }

  .aFloat {
    position: fixed;
    bottom: 0;
    right: 0;
  }

  .footer i {
    margin-right: 5px;
  }

  .active {
    text-decoration: underline;
    font-style: italic;
  }

  .modern-title {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-weight: 600;
    color: #333;
    text-transform: uppercase;
  }

  .modern-subtitle {
    font-family: 'Montserrat', sans-serif;
    font-size: 18px;
    font-weight: normal;
    color: #777;
    letter-spacing: 1px;
  }
</style>
<script>
  function openMaps() {
    var address = "7827 N Dale Mabry Hwy suite 212, Tampa, FL 33614";
    var encodedAddress = encodeURIComponent(address);
    var mapUrl = "https://www.google.com/maps/search/?api=1&query=" + encodedAddress;
    window.open(mapUrl);
  }

  $('#chatOnline').on('click', function() {


    $.ajax({

      type: "post",
      url: "<?php echo base_url('Home/showModalChatOnline'); ?>",
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
</script>

</html>