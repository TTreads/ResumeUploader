$(document).ready(function () {
    initHomeLink();

    $(".form-control").on('keydown', function (evt) {
        // Check if the input is not blank
        if (!$(this).val().trim().length <= 1) {
            $(this).removeClass('danger');
        }
    });

    $('#uploadBtn').on('click', function (evt) {
        evt.preventDefault();
        processForm();
    });


    $("#return_to_home").on('click', (evt) => {
        evt.preventDefault();
        ReturnToHome();
    })

    $('#resume').on('change', function () {
        // Get the selected file
        var selectedFile = this.files[0];
        $(this).removeClass('danger')
        // Check if a file is selected
        if (selectedFile) {
            // Get the file extension
            var fileExtension = selectedFile.name.split('.').pop().toLowerCase();

            // Check if the file ext is either pdf, doc, docx
            if (fileExtension !== 'pdf' && fileExtension !== 'doc' && fileExtension !== 'docx') {
                // Clear the file input if the file type is not allowed
                $(this).val('');
                alert('Please select a PDF or Word document.');
            }
        }
    });
});

function initHomeLink() {
    const homeURL = window.location.href;
    $('#return_to_home').attr('href', homeURL);
}

function processForm() {


    $('#uploadResumeForm input').each(function () {
        if ($(this).val().trim() === '') {
            $(this).addClass('danger');
        }
    });

    let firstName = $('#firstName').val();
    let lastName = $('#lastName').val();
    let email = $('#email').val();
    let resume = $('#resume').val();


    if (firstName != "" && lastName != "" && email != "" && resume != "") {
        // ajax
        var formData = new FormData($("#uploadResumeForm")[0]);

        // Perform the AJAX request
        $.ajax({
            url: 'api/',  // Change this to your actual API endpoint
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // This function will be called before the AJAX request is sent
                $("#user_first_name").html(firstName);

                $("#initial_view").addClass("animate__animated animate__fadeOutUp");
                showLoadingAnimation();
            },
            success: function (response) {
                // Handle the success response
                console.log(response);
            },
            error: function (error) {
                // Handle the error response
                console.log(error);
            },
            complete: function () {

                hideLoadingAnimation();
                setTimeout(() => {
                    $("#initial_view").hide();
                    $("#confirmation_view").show();
                }, 1000);
            }
        });
        console.log(`resume file`, resume)





    }


}



function ReturnToHome() {
    $("#confirmation_view").addClass("animate__fadeOutUp");
    $("#initial_view").removeClass("animate__fadeOutUp").addClass("animate__fadeInDown");
    $(".form-control").removeClass('danger');
    $("#uploadResumeForm").trigger("reset");
    $("#confirmation_view").hide();
    $("#initial_view").show();
}

function showLoadingAnimation() {
    $(".loading_indicator_overlay").show()
}


function hideLoadingAnimation() {

    $(".loading_indicator_overlay").hide()
}