<link rel="stylesheet" href="<?php echo base_url('assets/libs/dataTable/datatables.min.css'); ?>">
<div class="text-end m-3">
    <a href="<?php echo base_url('Admin'); ?>"><i class="mdi mdi-logout fs-1"></i>Logout</a>
</div>
<div class="m-5">
    <h2 class="mb-4 text-center fw-bold text-uppercase" style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Questions</h2>
    <table id="dtQuestions" class="display table-responsive">
        <thead>
            <tr>
                <th>Message</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message) : ?>
                <tr>
                    <td><?php echo $message->message; ?></td>
                    <td class="text-center"><i class=" fs-3 mdi mdi-send" style="cursor: pointer;" title="Responder" id="responseMsg" data-id="<?php echo $message->id; ?>"></i></td>
                    <td class="text-center"><i class=" fs-3 mdi mdi-delete" style="cursor: pointer;" title="Eliminar" id="delete" data-id="<?php echo $message->id; ?>"></i></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/dataTable/DataTables-1.13.5/js/dataTables.bootstrap5.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        let dtQuestions = $('#dtQuestions').DataTable({ // DATA TABLE REQUESTS
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
                    targets: [1, 2]
                },

            ],

        });

        dtQuestions.on('click', '#responseMsg', function() {

            $.ajax({
                type: "post",
                url: "<?php echo base_url('AdminActions/showModalRespondMessage') ?>",
                data: {
                    id: $('#responseMsg').attr('data-id')
                },
                dataType: "html",
                success: function(htmlResponse) {
                    $('#main-modal').html(htmlResponse);
                    $('#responseModal').modal('show');
                }
            });
        });

        dtQuestions.on('click', '#delete', function() {

            $.ajax({
                type: "post",
                url: "<?php echo base_url('AdminActions/deleteMessage') ?>",
                data: {
                    id: $('#delete').attr('data-id')
                },
                dataType: "json",
                success: function(jsonResponse) {
                    if (jsonResponse.error == 0)
                        showToast('success', 'Delete question');

                    else if (jsonResponse.error == 1)
                        showToast('error', 'Error on delete question');
                }
            });
        });
    });
</script>