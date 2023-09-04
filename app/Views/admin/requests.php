<link rel="stylesheet" href="<?php echo base_url('assets/libs/dataTable/datatables.min.css'); ?>">
<div class="container text-end mt-3">
      <a href="<?php echo base_url('Admin');?>"><i class="mdi mdi-logout fs-1"></i>Logout</a>
</div>
<div class="container mt-5">
  <h2 class="mb-4 text-center fw-bold">Patient Referrals</h2>
  <table id="dtRequests" class="display striped table-responsive">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Patient DOB</th>
        <th>Patient Height</th>
        <th>Patient Weight</th>
        <th>Diagnosis</th>
        <th>Referral Name</th>
        <th>Referral Phone</th>
        <th>Order Notes</th>
        <th>Image</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($requests as $request) : ?>
        <tr>
          <td id="name"><?php echo $request['name']; ?></td>
          <td id="email"><a href="mailto:<?php echo $request['email']; ?>" target="_blank" title="Enviar Correo"><?php echo $request['email']; ?></a></td>
          <td id="phone"><a href="tel:<?php echo $request['phone']; ?>"><?php echo $request['phone']; ?></a></td>
          <td id="patientDOB"><?php echo $request['patientDOB']; ?></td>
          <td id="patientHeight"><?php echo $request['patientHeight']; ?></td>
          <td id="patientWeight"><?php echo $request['patientWeight']; ?></td>
          <td id="diagnosis"><?php echo $request['diagnosis']; ?></td>
          <td id="referralName"><?php echo $request['referralName']; ?></td>
          <td id="referralPhone"><?php echo $request['referralPhone']; ?></td>
          <td id="orderNotes"><?php echo $request['orderNotes']; ?></td>
          <td id="image"><img id="image" src="data:image/png;base64, <?php echo base64_encode($request['image']); ?>" alt="Image" class="w-100"></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/dataTables.bootstrap5.min.js'); ?>"></script>
<script>
  $(document).ready(function() {


    let dtRequests = $('#dtRequests').DataTable({ // DATA TABLE REQUESTS
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
      order: [
        [0, 'des']
      ],
      columnDefs: [{
          orderable: false,
          targets: [10]
        },

      ],

    });

    dtRequests.on('click', '#image', function() {
      var imageUrl = $(this).attr('src');

      // Crear un elemento <img> para mostrar la imagen en grande
      var largeImage = $('<img>').attr('src', imageUrl);

      // Agregar estilos CSS para mostrar la imagen en grande
      largeImage.css({
        'position': 'fixed',
        'top': '50%',
        'left': '50%',
        'transform': 'translate(-50%, -50%)',
        'max-width': '90%',
        'max-height': '90%',
        'z-index': '9999'
      });

      // Agregar el elemento <img> al body del documento
      $('body').append(largeImage);

      // Cerrar la imagen en grande al hacer clic en ella
      largeImage.click(function() {
        $(this).remove();
      });
    });
  });
</script>