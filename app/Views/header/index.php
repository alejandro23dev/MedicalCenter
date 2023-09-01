<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Medical Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Medical Center" name="description" />
    <meta content="Medical Center" name="author" />

    <!-- <link rel="shortcut icon" type="image/x-icon" href="<?//php echo base_url('assets/images/'); ?>"> -->
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
    <div class="d-flex justify-content-end">
  <div>
  <p class="fs-5 me-5 fst-italic">Phone Number Contact: <a href="tel:877-233-233-233"><i class="mdi mdi-phone"></i> 877-233-233-233</a></p> 
  </div>
</div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar" style="height: 100px;">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav w-100 d-flex justify-content-between">
        <li class="nav-item">
          <a class="nav-link active text-white fw-bold fs-4 modern-title" href="<?php echo base_url('Home'); ?>">About US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fw-bold fs-4 modern-title" href="<?php echo base_url('Home/resources'); ?>">Resources</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fw-bold fs-4 modern-title" href="<?php echo base_url('Home/education'); ?>">Education</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fw-bold fs-4 modern-title" href="<?php echo base_url('Home/insurance'); ?>">Insurance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fw-bold fs-4 modern-title" href="<?php echo base_url('Home/patientReferral');?>">Patient Referral</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fw-bold fs-4 modern-title" href="<?php echo base_url('Home/contact'); ?>">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
            <?php echo view($page); ?>
    </div>
</body>
<style>
    .modern-title {
        font-family: 'Times New Roman', Times, serif;
        font-size: 32px;
        font-weight: bold;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .modern-subtitle {
        font-family: 'Montserrat', sans-serif;
        font-size: 18px;
        font-weight: normal;
        color: #777;
        letter-spacing: 1px;
    }
</style>
</html>