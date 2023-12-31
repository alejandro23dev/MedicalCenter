<link rel="stylesheet" href="<?php echo base_url('assets/libs/dataTable/datatables.min.css'); ?>">
<div class="m-5">
  <h2 class="mb-4 text-center fw-bold text-uppercase" style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Patient Referrals</h2>
  <table id="dtRequests" class="display table-responsive">
    <thead>
      <tr>
      <th>Status</th>
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
        <th>Date</th>
        <th>Document</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($requests as $request) : ?>
        <tr>
          <?php if($request['emailVerified'] == 0) :?>
        <td class="text-center"><i class="mdi mdi-alert-circle-check-outline text-danger" title="Email not verified"></i></td>
        <?php else :?>
          <td class="text-center"><i class="mdi mdi-check-circle-outline text-success" title="Email verified"></i></td>
        <?php endif;?>
          <td><?php echo $request['name']; ?></td>
          <td><a id="email" href="mailto:<?php echo $request['email']; ?>" target="_blank" title="Enviar Correo"><?php echo $request['email']; ?></a></td>
          <td><?php echo $request['phone']; ?></td>
          <td><?php echo $request['patientDOB']; ?></td>
          <td class="text-center"><?php echo $request['patientHeight']; ?></td>
          <td class="text-center"><?php echo $request['patientWeight']; ?></td>
          <td><?php echo $request['diagnosis']; ?></td>
          <td><?php echo $request['referralName']; ?></td>
          <td><?php echo $request['referralPhone']; ?></td>
          <td><?php echo $request['orderNotes']; ?></td>
          <td><?php echo $request['date']; ?></td>
          <td class="text-center"><i class="mdi mdi-file fs-2 text-primary file" style="cursor: pointer;" title="Open pdf file" data-id="<?php echo $request['id']; ?>"></i></td>
          <td><i class="mdi mdi-delete delete fs-2 text-danger" data-id="<?php echo $request['id']; ?>" title="Delete Patient" style="cursor: pointer;"></i></td>
        </tr>
      <?php endforeach ?>
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
          targets: [12, 13]
        },

      ],

    });

    dtRequests.on('click', '.file', function() {

      $.ajax({
        type: "post",
        url: "<?php echo base_url('AdminActions/getFile') ?>",
        data: {
          id: $(this).attr('data-id')
        },
        dataType: "html",
        success: function(htmlResponse) {
          $('#main-modal').html(htmlResponse);
          $('#pdfModal').modal('show');
        }
      });
    });

    dtRequests.on('click', '.delete', function() {

      $.ajax({
        type: "post",
        url: "<?php echo base_url('AdminActions/deletePatient') ?>",
        data: {
          id: $(this).attr('data-id')
        },
        dataType: "json",
        success: function(jsonResponse) {
          if (jsonResponse.error == 0) { // SUCCESS
            showToast('success', 'Eliminated patient');
            setTimeout(function() {
              window.location.reload();
            }, 2000);
          } else if (jsonResponse.error == 1) // ERROR
            showToast('error', 'Error deleting patient');

        }
      });
    });
  });
</script>