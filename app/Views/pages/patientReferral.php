<div style="position: relative; display: inline-block;">
    <img src="<?php echo base_url('assets/images/medical/patientReferral1.png'); ?>" alt="Image" class="w-100">
    <p style="position: absolute; bottom: 0; left: 10;" class="text-white fs-4 ms-2">Home / Patient Referral</p>
</div>
<div class="container mt-5 text-center">
    <div>
        <h1 class="modern-title">FILL OUT OUR FORM</h1>
        <h2 class="modern-subtitle">Making Memories Home Health carry a full line of wound care products,
            incontinence supplies, urological, ostomy and diabetic testing supplies delivered directly to the patient's home. We'll help
            determine the most appropriate and cost-effective supplies available. To refer a patient to Advanced Care Solutions and Complete
            Medical Supplies Inc, please fill out the form below.</h2>
    </div>
    <div class="text-center mt-5 col-8 mx-auto">
        <h1 class="modern-title">PERSONAL INFORMATION</h1>
        <div class="row">
            <div class="mb-3 text-start col-md-6">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" class="form-control modal-required focus text-capitalize" id="name" placeholder="Jorsh">
            </div>
            <div class="mb-3 text-start col-md-6">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control modal-required focus" id="email" placeholder="jorsh@gmail.com">
            </div>
        </div>
        <div class="row">
            <div class="text-start col-md-6">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <div class="input-group mb-3">
                    <span class="input-group-text text-muted">+1</span>
                    <input type="text" class="form-control modal-required focus" id="phone" placeholder="(123) 678-1234" minlength="10" maxlength="10">
                </div>
            </div>
            <div class="mb-3 text-start col-md-6">
                <label for="patientDOB" class="form-label fw-bold">Patient DOB</label>
                <input type="date" class="form-control modal-required focus" id="patientDOB" minlength="2" maxlength="4">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 text-start col-md-6">
                <label for="patientHeight" class="form-label fw-bold">Height </label> (<span class="text-muted fst-italic">feet inches</span>)
                <input type="text" class="form-control modal-required focus" id="patientHeight" minlength="1" maxlength="2">
            </div>
            <div class=" mb-3 text-start col-md-6 ">
                <label for="weight" class="form-label fw-bold">Weight</label> (<span class="text-muted fst-italic">Pounds</span>)
                <input type="text" class="form-control modal-required focus" id="weight" minlength="2" maxlength="3">
            </div>
        </div>
        <div class="row">
            <div class="text-start col-md-6">
                <label for="referralPhone" class="form-label fw-bold">Ordering Referral Phone</label>
                <div class="input-group mb-3">
                    <span class="input-group-text text-muted">+1</span>
                    <input type="text" class="form-control modal-required focus" id="referralPhone" placeholder="(123) 678-1234" minlength="10" maxlength="10">
                </div>
            </div>
            <div class=" mb-3 text-start col-md-6">
                <label for="referralName" class="form-label fw-bold">Ordering Referral Name</label>
                <input type="text" class="form-control modal-required focus text-capitalize" id="referralName" placeholder="Alex Smith MD">
            </div>
        </div>
        <div class="row">
            <div class=" mb-3 text-start col-md-6">
                <label for="diagnosis" class="form-label fw-bold">Diagnosis/ICD10</label>
                <textarea cols="3" class="form-control modal-required focus text-capitalize" id="diagnosis" placeholder=""></textarea>
            </div>
            <div class="mb-3 text-start col-md-6">
                <label for="orderNotes" class="form-label fw-bold">Order Notes</label>
                <textarea class="form-control modal-required focus text-capitalize" id="orderNotes" placeholder=""></textarea>
            </div>
        </div>
        <div class="mb-3 text-start">
            <label for="file" class="form-label fw-bold">Upload Documents</label>
            <div class="input-group">
                <input type="file" class="form-control modal-required focus" id="file" accept=".pdf">
            </div>
        </div>
        <div id="resendEmail">
        </div>
        <div class="mb-5">
            <button id="btn-send" class="btn col-6 mt-2 text-white fw-bold fs-5" style="background-color: #005081;">Submit</button>
        </div>
    </div>
</div>
<?php echo view('global/formValidation'); ?>

<script>
    $(document).ready(function() {

        $('#patientReferral').addClass('active');

        $("#patientHeight").on("keypress", function() {
            var value = $(this).val();
            var replacedValue = value.replace(/(\d+)'/g, "$1'").replace(/(\d+)"/g, "$1\"");

            $(this).val(replacedValue);
        });

        $('#weight, #patientHeight').on('input', function() {
            // Remueve cualquier caracter no numérico
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('#referralPhone, #phone').on('input', function() {
            var formattedNumber = $(this).val().replace(/\D/g, '');
            if (formattedNumber.length === 10) {
                formattedNumber = '(' + formattedNumber.substring(0, 3) + ') ' + formattedNumber.substring(3, 6) + '-' + formattedNumber.substring(6, 10);
            }
            $(this).val(formattedNumber);
        });

        $('#btn-send').click(function(e) {

            e.preventDefault();

            let resultCheckRequiredValues = checkRequiredValues('modal-required');
            let phone = "+1" + $('#phone').val();
            let referralPhone = "+1" + $('#referralPhone').val();

            if (resultCheckRequiredValues == 0) {

                if (phone != referralPhone) {

                if ($('#file').val() != '') {

                    let url = "<?php echo base_url('Home/verifyEmail'); ?>";

                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            name: $('#name').val(),
                            email: $('#email').val(),
                            phone: phone,
                            patientDOB: $('#patientDOB').val(),
                            patientHeight: $('#patientHeight').val(),
                            patientWeight: $('#weight').val(),
                            diagnosis: $('#diagnosis').val(),
                            referralName: $('#referralName').val(),
                            referralPhone: referralPhone,
                            orderNotes: $('#orderNotes').val()
                        },
                        dataType: "json",
                        success: function(jsonResponse) {
                            if (jsonResponse.error == 0) // SUCCESS
                                showToast('info', 'We have sent a verification email to your email address to make sure it belongs to you');

                            else if (jsonResponse.error == 1) { // ERROR SEND EMAIL
                                showToast('error', 'Verification email could not be sent');
                                $("#resendEmail").html("<a href='' id='btn-resendEmail'>Resend verification email</a>");
                                $('#btn-resendEmail').click(function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: "post",
                                        url: "<?php echo base_url('Home/resendVerifyEmail'); ?>",
                                        data: {
                                            name: $('#name').val(),
                                            email: $('#email').val(),
                                            phone: "+1" + $('#phone').val(),
                                            patientDOB: $('#patientDOB').val(),
                                            patientHeight: $('#patientHeight').val(),
                                            patientWeight: $('#weight').val(),
                                            diagnosis: $('#diagnosis').val(),
                                            referralName: $('#referralName').val(),
                                            referralPhone: "+1" + $('#referralPhone').val(),
                                            orderNotes: $('#orderNotes').val()
                                        },
                                        dataType: "json",
                                        success: function(jsonResponse) {
                                            if (jsonResponse.error == 0) // SUCCESS
                                                showToast('info', 'We have resent a Reverification email to your email address');

                                            else if (jsonResponse.error == 1) // ERROR
                                                showToast('error', 'Reverification email could not be sent');

                                            else if (jsonResponse.error == 2) // ERROR
                                                showToast('error', 'Please verify your information');

                                            else if (jsonResponse.error == 3) { // ERROR INVALID EMAIL FORMAT
                                                showToast('error', 'Invalid Email');
                                                $('#email').addClass('is-invalid');
                                            }
                                        }
                                    });
                                });
                            } else if (jsonResponse.error == 2) // ERROR EMPTY FIELDS
                                showToast('error', 'Please enter the information correctly');

                            else if (jsonResponse.error == 3) { // ERROR INVALID EMAIL FORMAT
                                showToast('error', 'Invalid Email');
                                $('#email').addClass('is-invalid');

                            } else if (jsonResponse.error == 4) { // ERROR EMAIL REGISTER
                                showToast('error', 'The email is already registered');
                                $('#email').addClass('is-invalid');
                            } else if (jsonResponse.error == 7) { // ERROR NUMBER REGISTER
                                showToast('error', 'The number is already registered');
                                $('#phone').addClass('is-invalid');
                            } else if (jsonResponse.error == 8) { // ERROR NUMBER LENGTH
                                $('#phone').addClass('is-invalid');
                            } else if (jsonResponse.error == 9) { // ERROR NUMBER LENGTH
                                $('#referralPhone').addClass('is-invalid');
                            }
                            var formData = new FormData();

                            formData.append('id', jsonResponse.id);
                            formData.append('file', $("#file")[0].files[0]); // UPLOAD FILE

                            $.ajax({
                                type: "post",
                                url: "<?php echo base_url('Home/uploadFile'); ?>",
                                data: formData,
                                dataType: "json",
                                cache: false,
                                contentType: false,
                                processData: false,

                                success: function(jsonResponse) {
                                    if (jsonResponse.error == 1) {
                                        showToast('error', 'You must upload a file')
                                        $('#file').addClass('is-invalid');
                                    }
                                },
                                error: function(error) {
                                    showToast('error', 'Ha ocurrido un error');
                                },
                            });
                        },

                        error: function(error) {
                            showToast('error', 'Ha ocurrido un error')
                        }
                    })
                } else {
                    showToast('error', 'You must upload a file')
                    $('#file').addClass('is-invalid');
                }
            } else{
                showToast('error', 'Numeros iguales')
                    $('#phone').addClass('is-invalid');
                    $('#referralPhone').addClass('is-invalid');
            }
            }
        });
    });
</script>