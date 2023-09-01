<div class="container mt-5 text-center">

    <div>
        <h1 class="modern-title">FILL OUT OUR FORM</h1>
        <h2 class="modern-subtitle">Advanced Care Solutions and Complete Medical Supplies Inc carry a full line of wound care products, incontinence supplies, urological, ostomy and diabetic testing supplies delivered directly to the patient's home. We'll help determine the most appropriate and cost-effective supplies available. To refer a patient to Advanced Care Solutions and Complete Medical Supplies Inc, please fill out the form below.</h2>
    </div>
    
    <div class="text-center mt-5 col-8 mx-auto">
    <h1 class="modern-title">PERSONAL INFORMATION</h1>
        <div class="form-floating form-floating-custom mb-3">
            <input type="text" class="form-control modal-required focus" id="name" placeholder="Name">
            <label for="name">Name</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="email" class="form-control modal-required focus" id="email" placeholder="Email">
            <label for="email">Email</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="text" class="form-control modal-required focus" id="phone" placeholder="Phone">
            <label for="phone">Phone</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <select class="form-select modal-required focus" id="suppliesNeeded" name="suppliesNeeded">
                <option value="" selected disabled>Select Supplies Needed</option>
                <option value="woundCare">Wound Care Products</option>
                <option value="incontinence">Incontinence Supplies</option>
                <option value="urological">Urological Supplies</option>
                <option value="ostomy">Ostomy Supplies</option>
                <option value="diabetic">Diabetic Testing Supplies</option>
            </select>
            <label for="suppliesNeeded">Supplies Needed</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="text" class="form-control modal-required focus" id="patientDOB" placeholder="Patient DOB">
            <label for="patientDOB">Patient DOB</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="text" class="form-control modal-required focus" id="patientHeight" placeholder="Height">
            <label for="patientHeight">Height</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="text" class="form-control modal-required focus" id="weight" placeholder="Weight">
            <label for="weight">Weight</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <textarea cols="3" class="form-control modal-required focus" id="diagnosis" placeholder="Diagnosis/ICD10"></textarea> <!-- Cierra la etiqueta <textarea> -->
            <label for="diagnosis">Diagnosis/ICD10</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="text" class="form-control modal-required focus" id="referralName" placeholder="Ordering Referral Name">
            <label for="referralName">Ordering Referral Name</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="text" class="form-control modal-required focus" id="referralPhone" placeholder="Ordering Referral Phone">
            <label for="referralPhone">Ordering Referral Phone</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <textarea class="form-control modal-required focus" id="orderNotes" placeholder="Order Notes"></textarea> <!-- Cierra la etiqueta <textarea> -->
            <label for="orderNotes">Order Notes</label>
            <div class="form-floating-icon">
                <i class="mdi mdi-account"></i>
            </div>
        </div>
        <div class="mb-3 text-start">
            <label for="fileInput" class="form-label fw-bold">Upload Documents</label>
            <div class="input-group">
                <input type="file" class="form-control" id="fileInput">
            </div>
        </div>
        <div class="mb-5">
            <button id="btn-send" class="btn btn-dark col-8" style="height: 50px;">SEND</button>
        </div>
    </div>
</div>
<?php echo view('global/formValidation'); ?>

<script>
    $(document).ready(function () {

        $('#btn-send').click(function (e) { 

            e.preventDefault();

            let resultCheckRequiredValues = checkRequiredValues('modal-required');

            if (resultCheckRequiredValues == 0) {

                let url = <?php echo base_url('Home/sendInfo');?>;
                
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        username: $('#createUser').val(),
                        email: $('#createEmail').val(),
                        gender: $('#createGender').val(),
                        cardNumber: $('#createCardNumber').val(),
                        cash: $('#insertCash').val(),
                        password: $('#createPassword').val(),
                        country: $('#country').val(),
                        province: $('#province').val(),
                        municipality: $('#municipality').val(),
                        distribution: $('#distribution').val()
                    },
                    dataType: "json",
                    success: function(jsonResponse) {
                        if (jsonResponse.error == 0) { // SUCCESS
                            showToastCenter('success', jsonResponse.msg);
                        }
                    },
                    
                    error: function(error) {
                        showToast('error', 'Ha ocurrido un error')
                    }
                })
            }
            
        });
    });
</script>