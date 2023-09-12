<link rel="stylesheet" href="<?php echo base_url('assets/libs/dataTable/datatables.min.css'); ?>">
<div class="m-5">
  <h2 class="mb-4 text-center fw-bold text-uppercase" style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Patient Referrals</h2>
  <table id="dtRequests" class="display table-responsive">
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
        <th>Date</th>
        <th>Document</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($requests as $request) : ?>
        <tr>
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
          <td class="text-center"><i class="mdi mdi-file fs-2" id="file" style="cursor: pointer;" title="Open pdf file" data-id="<?php echo $request['id']; ?>" ></i></td>
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
          targets: [11]
        },

      ],

    });

    dtRequests.on('click', '#file', function() {
      
      $.ajax({
        type: "post",
        url: "<?php echo base_url('AdminActions/getFile')?>",
        data:{
          id : $('#file').attr('data-id')
        },
        dataType: "html",
        success: function (htmlResponse) {
          $('#main-modal').html(htmlResponse);
          $('#pdfModal').modal('show');
        }
      });
    });
  });
</script>