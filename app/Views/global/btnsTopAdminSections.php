<div class="row badge-soft-success mt-2 rounded-3">
  <div class="col-3 col-md-3 mt-5">
    <button type="button" id="btn-productsSection" class="btn btn-dark">Mis Productos</button>
  </div>
  <div class="col-3 col-md-3 mt-5">
    <button type="button" id="btn-sendSection" class="btn btn-dark">Mis Pedidos</button>
  </div>
  <div class="col-3 col-md-3 mt-5">
    <button type="button" id="btn-sendDrivers" class="btn btn-dark">Mis Conductores</button>
  </div>

  <ul class="navbar-nav col-3  col-md-3 mt-5 ">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-success d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="<?php echo base_url('assets/images/users/avatarAdminSetting.png'); ?>" alt="admin" class="img-fluid mb-2 me-3" width="50px">
        <div>
          <h5 class="text-start text-black-50 fst-italic mb-0"><?php echo $adminData['user'] ?></h5>
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

<script>
  // SECTION PRODUCTS
  $('#btn-productsSection').on('click', function() {
    window.location.href = "<?php echo base_url('AdminActions/products') ?>";
  });

  // SECTION requests
  $('#btn-sendSection').on('click', function() {
    window.location.href = "<?php echo base_url('AdminActions/requests') ?>";
  });

  // SECTION drivers
  $('#btn-sendDrivers').on('click', function() {
    window.location.href = "<?php echo base_url('AdminActions/drivers') ?>";
  });
</script>