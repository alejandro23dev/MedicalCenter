<script>   
  var id = "<?php echo $result[0]->id ?>";

  $.ajax({
    type: "post",
    url: "<?php echo base_url('Home/sendInfo') ?>",
    data: {
      id: id
    },
    dataType: "json",
    success: function(jsonResponse) {
      if (jsonResponse.error == 0) {// SUCCESS
        showToastCenter('success', 'Patient Referral has been sent');
        window.location.href = "<?php echo base_url('Home') ?>?=msgSuccessVerify";
      }
      else if (jsonResponse.error == 1) // ERROR
        showToast('error', 'Patient Referral could not be sent');
    }
  });
</script>