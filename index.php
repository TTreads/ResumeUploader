<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Uploader</title>
    <!-- Included Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- My app.css file -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Included jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-content-center" id="initial_view">
            <div class="col-12">
                <h2 class="mt-3 animate__animated animate__fadeIn animate__delay-1s mb-1">Hello.</h2>
                <div class="animate__animated animate__fadeIn animate__delay-2s secondary_label">Welcome to Resume
                    Uploader, fill in the form
                    below.
                </div>
                <form id="uploadResumeForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"><div class="form-floating mb-3 animate__animated animate__fadeIn animate__delay-3s">
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Tyler"
                            required>
                        <label for="firstName">First Name</label>
                    </div>
                    </div>
                        <div class="col-sm-12 col-md-6"><div class="form-floating mb-3 animate__animated animate__fadeIn animate__delay-4s">
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Tyler"
                            required>
                        <label for="lastName">Last Name</label>
                    </div></div>
                    </div>
                    <div class="form-floating mb-3 animate__animated animate__fadeIn animate__delay-5s">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
                            required>
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3 animate__animated animate__fadeIn animate__delay-5s">
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Enter phone number" required>
                        <label for="phone">Phone</label>
                    </div>





                    <div class="form-group animate__animated animate__fadeIn animate__delay-5s mb-5">
                        <div class="secondary_label pb-2 pt-4" for="resume">Upload Resume:</div>
                        <input type="file" class="form-control-file" name="resume" id="resume" required>
                    </div>
                    <div class="animate__animated animate__fadeIn animate__delay-5s">

                        <button type="button" class="btn btn-primary" id="uploadBtn">Submit Resume</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="row justify-content-center align-content-center" id="confirmation_view" style="display: none">
            <div id="status_view" class="animate__animated animate__fadeInUp">
                <div id="status">
                    <h1 class="mt-3 mb-3 animate__animated animate__fadeIn animate__delay-1s">Thank You <span
                            id="user_first_name"></span>!</h1>
                    <h2 class="mt-3 mb-5 animate__animated animate__fadeIn animate__delay-2s">Submission successful.<br>
                        You
                        will hear from us shortly.</h2>
                    <div class="animate__animated animate__fadeIn animate__delay-2s secondary_label">
                        <a id="return_to_home" href="#"><button type="button" class="btn btn-primary cta_btn">Return to
                                Home</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="loading_indicator_overlay" style="display:none;">
        <div class="container">
            <div class="row justify-content-center align-items-center h-100vh">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
</div>
        </div>
    </div>

    <footer>
        <p class="animate__animated animate__fadeInUp">&copy; 2023 - Tyler Treadwell's Project. All rights reserved.</p>
    </footer>
    <!-- Included Bootstrap JS and Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="js/main.js">

    </script>


</body>

</html>