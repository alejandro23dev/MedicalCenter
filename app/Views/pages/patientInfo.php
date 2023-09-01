<div class="container mt-5">
  <div class="text-center"> <!-- Añade la clase text-center para alinear al centro -->
    <div class="form-floating form-floating-custom mb-3">
      <input type="text" class="form-control modal-required focus" id="phoneNumber" placeholder="Patient Phone Number">
      <label for="phoneNumber">Patient Phone Number</label>
      <div class="form-floating-icon">
        <i class="mdi mdi-account"></i>
      </div>
    </div>
    <div class="form-floating form-floating-custom mb-3">
      <input type="text" class="form-control modal-required focus" id="patientDOB" placeholder="Patient DOB">
      <label for="patientDOB">Patient DOB</label>
    </div>
    <div class="form-floating form-floating-custom mb-3">
      <input type="text" class="form-control modal-required focus" id="patientHeight" placeholder="Height">
      <label for="patientHeight">Height</label>
      <div class="form-floating-icon">
        <i class="mdi mdi-account-cash"></i>
      </div>
    </div>
    <div class="form-floating form-floating-custom mb-3">
      <input type="text" class="form-control modal-required focus" id="weight" placeholder="Weight">
      <label for="weight">Weight</label>
      <div class="form-floating-icon">
        <i class="mdi mdi-account-cash"></i>
      </div>
    </div>
    <div class="form-floating form-floating-custom mb-3">
      <textarea cols="3" class="form-control modal-required focus" id="diagnosis" placeholder="Diagnosis/ICD10"></textarea> <!-- Cierra la etiqueta <textarea> -->
      <label for="diagnosis">Diagnosis/ICD10</label>
      <div class="form-floating-icon">
        <i class="mdi mdi-account-cash"></i>
      </div>
    </div>
    <div class="form-floating form-floating-custom mb-3">
      <input type="text" class="form-control modal-required focus" id="referralName" placeholder="Ordering Referral Name">
      <label for="referralName">Ordering Referral Name</label>
      <div class="form-floating-icon">
        <i class="mdi mdi-account-cash"></i>
      </div>
    </div>
    <div class="form-floating form-floating-custom mb-3">
      <input type="text" class="form-control modal-required focus" id="referralPhone" placeholder="Ordering Referral Phone">
      <label for="referralPhone">Ordering Referral Phone</label>
      <div class="form-floating-icon">
        <i class="mdi mdi-account-cash"></i>
      </div>
    </div>
    <div class="form-floating form-floating-custom mb-3">
      <textarea cols="3" class="form-control modal-required focus" id="orderNotes" placeholder="Order Notes"></textarea> <!-- Cierra la etiqueta <textarea> -->
      <label for="orderNotes">Order Notes</label>
      <div class="form-floating-icon">
        <i class="mdi mdi-account-cash"></i>
      </div>
    </div>
  </div>
</div>     
<?php echo view('global/formValidation'); ?>
