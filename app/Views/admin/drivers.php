<link rel="stylesheet" href="<?php echo base_url('assets/libs/dataTable/datatables.min.css'); ?>">
<div class="row">
  <?php echo view('global/btnsTopAdminSections') ?>

  <div class="container mt-5">
    <h2 class="mb-4 text-center">Conductores</h2>
    <div class="text-center">
      <button class=" btn btn-success shadow" id="btn-createAccount">Crear Conductor</button>
    </div>
    <table id="dtDrivers" class="display striped table-responsive">
      <thead>
        <tr>
          <th>ID</th>
          <th>Imagen</th>
          <th>Conductor</th>
          <th>Telefono</th>
          <th>ID de Compra</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($drivers as $driver) : ?>
          <tr>
            <td><?php echo $driver['id']; ?></td>
            <td>
              <?php if (empty($driver['image'])) : ?>
                <img src="<?php echo base_url('assets/images/users/avatarNoPerfilPhoto.png'); ?>" alt="Imagen Vacía del conductor" style="width: 150px;">
              <?php else : ?>
                <img src="data:image/png;base64, <?php echo base64_encode($driver['image']); ?>" alt="Imagen del conductor" class="w-25">
              <?php endif; ?>
            </td>
            <td><?php echo $driver['name'] ?></td>
            <td><?php echo $driver['phoneNumber'] ?></td>
            <td><?php echo $driver['requestID'] ?></td>
            <td><button class="btn btn-success" id="btn-successRequest" data-id="<?php echo $driver['id']; ?>" title="Pedido Completado"><i class="mdi mdi-account-box-multiple"></i></button></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/dataTables.bootstrap5.min.js'); ?>"></script>

  <script>
    $(document).ready(function() {

      let dtDrivers = $('#dtDrivers').DataTable({ // DATA TABLE PRODUCT
        destroy: true,
        processing: false,
        serverSide: false,
        responsive: true,
        bAutoWidth: true,
        pageLength: 25,
        lengthMenu: [
          [5, 10, 25, 50],
          [5, 10, 25, 50]
        ],
        language: {
          url: '<?php echo base_url('assets/libs/dataTable/es.json'); ?>'
        },

        order: [
          [1, 'asc']
        ],
        columnDefs: [{
            orderable: false,
            targets: 5
          },

        ],

      });

      // CREATE DRIVER ACCOUNT
      $('#btn-createAccount').on('click', function(e) {

        e.preventDefault();

        $.ajax({

          type: "post",
          url: "<?php echo base_url('Drivers/showModalCreateDriver') ?>",
          data: {
            action: 'create'
          },
          dataType: "html",
          success: function(htmlResponse) {
            $('#main-modal').html(htmlResponse);
          },
          error: function(error) {
            showToast('error', 'Ha ocurrido un error');
          }
        });
      });
    });
  </script>