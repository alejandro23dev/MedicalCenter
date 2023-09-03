<link rel="stylesheet" href="<?php echo base_url('assets/libs/dataTable/datatables.min.css'); ?>">
<div class="row">
</div>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Requests</h2>

  
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
          <tr id="<?php echo $request['id']; ?>">
            <td id="name"><?php echo $request['name'] ?></td>
            <td id="email"><a href="mailto:<?php echo $request['email'] ?>" target="_blank" title="Enviar Correo"><?php echo $request['email'] ?></a></td>
            <td id="phone"><?php echo $request['phone'] ?></td>
            <td id="patientDOB"><?php echo $request['patientDOB']; ?></td>
            <td id="patientHeight"><?php echo $request['patientHeight']; ?></td>
            <td id="patientWeight"><?php echo $request['patientWeight']; ?></td>
            <td id="diagnosis"><?php echo $request['diagnosis']; ?></td>
            <td id="referralName"><?php echo $request['referralName']; ?></td>
            <td id="referralPhone"><?php echo $request['referralPhone']; ?></td>
            <td id="orderNotes"><?php echo $request['orderNotes'] ?></td>
            <td id="image">$<?php echo $request['image'] ?></td>
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
  

  });

</script>