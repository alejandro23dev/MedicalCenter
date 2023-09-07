<div class="row mt-2 rounded-3">
  <div class="col-2 text-center bg-primary rounded m-4">
  <a id="Home" class="text-black fs-5" href="<?php echo base_url('AdminActions/patientsReferrals'); ?>">Patients Referral</a>
  </div>
  <div class="col-2 text-center bg-primary rounded m-4">
  <a id="message" class="text-black fs-5" href="<?php echo base_url('AdminActions/messages'); ?>">Questions of patients</a>
  </div>
  <ul class="navbar-nav col-3">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-success d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="<?php echo base_url('assets/images/users/avatarAdminSetting.png'); ?>" alt="admin" class="img-fluid mb-2 me-3" width="50px">
        <div class="">
          <h5 class="text-start text-black-50 fst-italic mb-0"></h5>
        </div>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a class="dropdown-item" href="<?php echo base_url('Admin'); ?>"><span><img class="w-25" src="<?php echo base_url('assets/images/logout.png')?>" alt="avatar"></span> Salir </a>
        </li>
      </ul>
    </li>
  </ul>
</div>