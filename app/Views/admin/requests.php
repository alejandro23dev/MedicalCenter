<link rel="stylesheet" href="<?php echo base_url('assets/libs/dataTable/datatables.min.css'); ?>">
<div class="row">
<?php echo view('global/btnsTopAdminSections')?>
</div>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Pedidos</h2>

  
    <table id="dtRequests" class="display striped table-responsive">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Email</th>
          <th>Pedido</th>
          <th>Fecha de Compra</th>
          <th>Fecha Máx de Entrega</th>
          <th>Pais</th>
          <th>Provincia</th>
          <th>Municipio</th>
          <th>Reparto</th>
          <th>Dirección</th>
          <th>Total</th>
          <th>Info</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($requests as $request) : ?>
          <tr id="<?php echo $request['id']; ?>">
            <td id="id"><?php echo $request['id']; ?></td>
            <td id="client"><?php echo $request['client'] ?></td>
            <td id="email"><a href="mailto:<?php echo $request['email'] ?>" target="_blank" title="Enviar Correo"><?php echo $request['email'] ?></a></td>
            <td id="request"><?php echo $request['request'] ?></td>
            <td id="date"><?php echo $request['date']; ?></td>
            <td id="dateClose"><?php echo $request['dateClose']; ?></td>
            <td id="country"><?php echo $request['country']; ?></td>
            <td id="province"><?php echo $request['province']; ?></td>
            <td id="municipality"><?php echo $request['municipality']; ?></td>
            <td id="distribution"><?php echo $request['distribution']; ?></td>
            <td id="address"><?php echo $request['address'] ?></td>
            <td id="totalPrice">$<?php echo $request['totalPrice'] ?></td>
            <td id="infoRequest"><?php echo $request['info'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
</div>

<script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/dataTables.bootstrap5.min.js'); ?>"></script>

<script>
  $(document).ready(function() {

    $('#btn-successRequest').on('click', function() {
      $.ajax({
        type: "post",
        url: "<?php echo base_url('AdminActions/requests') ?>",
        data: {
          action : 'success'
        },
        dataType: "json",
        success: function (jsonResponse) {
          showToast('success','Envío Realizado')
        }, error: function(error){
          showToast('error','Ha ocurrido un error')
        }
      });
    });

    let dtRequests = $('#dtRequests').DataTable({ // DATA TABLE REQUESTS CANCELLED
      destroy: true,
      processing: false,
      serverSide: false,
      responsive: true,
      bAutoWidth: true,
      pageLength: 10,
      lengthMenu: [
        [5, 10, 25, 50],
        [5, 10, 25, 50]
      ],
      language: {
        url: '<?php echo base_url('assets/libs/dataTable/es.json'); ?>'
      },

      order: [
        [0, 'des']
      ],
      columnDefs: [{
          orderable: false,
          targets: [9, 11, 12]
        },

      ],

    });
    
    <?php if (isset($jsonResponse)) : ?>
    <?php foreach ($jsonResponse as $requestID => $response) : ?>
      // Verificar si jsonResponse.error es igual a 7
      if (<?php echo $response['error']; ?> === 7) {
        // Obtener el ID del pedido
        const requestID = <?php echo $requestID; ?>;
        
        // Realizar la llamada Ajax para actualizar el campo info en la base de datos
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('AdminActions/requests') ?>",
          data: {
            infoRequestsUpdate: 'Pedido NO Realizado',
            requestID: requestID
          },
          dataType: "text",
          success: function (response) {
            // Resto de tu código de éxito
          }
        });
      }
    <?php endforeach; ?>
  <?php endif; ?>

  });

</script>