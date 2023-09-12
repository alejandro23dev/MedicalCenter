<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-close" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" style="overflow-y: auto;">
                <div class="container">
                    <div class="container">
                        <embed src="data:application/pdf;base64,<?php echo base64_encode($document); ?>" type="application/pdf" width="100%"  height="500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-close').on('click', function() { // ON CLOSE

        $('#pdfModal').modal('hide');
        $('#main-modal').html('');

    });
</script>