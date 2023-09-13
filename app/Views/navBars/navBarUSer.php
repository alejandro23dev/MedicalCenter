<nav class="navbar navbar-expand-lg sticky-top" style="background-color: #005081;">
  <div class="container-fluid">
    <i class="navbar-toggler bi bi-list align-items-end text-white" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <img src="<?php echo base_url('assets/mmhhlogo.png'); ?>" alt="Image" class="w-25">
      <ul class="navbar-nav w-100 d-flex justify-content-between m-3">
        <li class="nav-item">
          <a id="Home" class="nav-link text-white fs-3 modern-title " href="<?php echo base_url('Home'); ?>">ABOUT US</a>
        </li>
        <li class="dropdown mt-2">
          <a class="dropdown-toggle text-white fs-3 modern-title cursorPointer" id="contactDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            Contact Us <i class="mdi mdi-arrow-down"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="contactDropdown">
            <li><a class="dropdown-item" href="tel:+18139310015"><i class="mdi mdi-phone"></i> +1 (813) 931-0015</a></li>
            <li><a class="dropdown-item" href="tel:+18139310017"><i class="mdi mdi-fax"></i> +1 (813) 931-0017</a></li>
            <li><a class="dropdown-item" href="mailto:Makingmemorieshomehealth@gmail.com"><i class="mdi mdi-email"></i> Makingmemorieshomehealth@gmail.com</a></li>
            <li><a class="dropdown-item" href="#" onclick="openMaps()"><i class="mdi mdi-map-marker"></i> 7827 N Dale Mabry Hwy suite 212 <br> Tampa, FL 33614</a></li>
          </ul>
        </li>
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