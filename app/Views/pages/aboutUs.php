<div style="position: relative; display: inline-block;">
    <img src="<?php echo base_url('assets/images/medical/AboutUS1.png'); ?>" alt="Image" class="w-100">
    <p style="position: absolute; bottom: 0; left: 10;" class="text-white fs-4 ms-2">Home / About US</p>
</div>
<div class="container mt-5 text-center">
    <div>
        <h1 class="modern-title">About Us</h1>
        <h2 class="modern-subtitle text-start">Our Agency is a licensed home health agency that provides the following services. <br>
            1. Skilled nursing services(Registered Nurse, Licensed Practical Nurse). <br>
            2. Therapy Services (Physical / Occupational / Speech) <br>
            3. Home health aide / Certified Nursing Assistant services <br>
            4. Medical Social Worker <br>
            Our Agency and its staff operate and furnish services in compliance with all applicable Federal, State and local laws and regulations.
            The Director of Nursing was involved in implementing the program. The Agency's Program is reviewed and approved annually by the Board of Directors. Additionally, an evaluation of the effectiveness of the program will be performed annually
            Administrative and supervisory functions arenot delegated to another agency ororganization
            All home health services are furnish directly by the agency. Our Agency does not have any subunits</h2>
    </div>
    <div class="mt-5">
        <h1 class="modern-title">Objectives</h1>
        <h2 class="modern-subtitle text-start">Our Agency objective are as follows <br>
            1. To provide a planned and systematic approach to the professional services rendered including contract services. <br>
            2. To provide quality services <br>
            3. To provide criteria for standard of care, ensuring implementation of state guidelines <br>
            4. To provide in service education opportunities to update knowledge and skills to all agency staff <br>
            5. To provide a methodology for on-going monitoring of apropriate utilization of agency services and quality of delivery
            6 To provide skilled nursing, therapy personal care and assistance with activities of daily living and medical social service
            to all patients without regard to race, color, religion, national ongin age, sex, physical or mental disability. Services will
            be provided directly Medicare, Medicaid, private paid or insurance with a reasonable expectation that the services can be provided
            adequately and safely in the patient's place of residence</h2>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Obtener la URL actual
        var currentUrl = window.location.href;

        // Verificar si la URL contiene la palabra "msgSuccessVerify"
        if (currentUrl.includes('msgSuccessVerify')) {
            var toast = showToast('success', 'Your email has been verified');
        }
        else if (currentUrl.includes('msgEmptyToken')) {
            var toast = showToast('success', 'Your token has expired');
        }

        $('#Home').addClass('active');

    });
</script>