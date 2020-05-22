<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./assets/css/login.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="./assets/initTelInput/css/intlTelInput.min.css">
    <!--===============================================================================================-->
    <script src="./assets/initTelInput/js/intlTelInput.js"></script>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!--===============================================================================================-->
</head>

<body>
    <div class="container_all">
        <div class="logo">
            <img src="./assets/logos/edufrance.png" alt="edufrance logo">
        </div>
        <div class="text_top_container">
            <div class="grid_wrapper">
                <div class="text_left">
                    <h1>
                        &nbsp; &nbsp; &nbsp; &nbsp;09 <br>
                        &nbsp; &nbsp;MAI <br>
                        &nbsp;2020
                    </h1>
                </div>
                <div class="text_right">
                    <h1>
                        JOURNÉE <br>
                        PORTES OUVERTES <br>
                        VIRTUELLE
                    </h1>
                </div>
            </div>
            <div class="under_text">
                <h4>Spécial Rentrée 2020-21</h4>
            </div>
        </div>

        <div class="mobile_country_icons">
            <div class="tn">
                <img src="./assets/icons/tunisia.png" alt="tunisia icon">
            </div>
            <h4>Etudier <br> En France </h4>
            <div class="fr">
                <img src="./assets/icons/france.png" alt="french icon">
            </div>
        </div>

        <div class="background_left">
            <img src="./assets/icons/arrow.png" alt="arrow icon">
            <img src="./assets/img/img.png" alt="background image">
        </div>

        <form action="" method="post" name="signin_form" id="signup_form" class="signin_form d-none">
            <h4>Inscrivez-vous <br>
                à l’évènement <br>
                & recevez votre badge
            </h4>
            <div class="form-row mt-4">
                <div class="form-group col-md-6">
                    <input type="email" class="form-control" name="this_is_an_username" id="this_is_an_username" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control input-fixer" name="this_is_a_phone" id="this_is_a_phone" placeholder="Numéro de téléphone" required>
            </div>
            <center style="margin-top: 20px; margin-bottom: 20px">
                <button type="submit" name="submit_sign_in" class="btn btn-primary">
                    S’inscrire
                </button>
            </center>
            <a href="#" id="goSignUp" class="change_block">Inscrivez-vous</a>
        </form>
        <form action="" method="post" name="signup_form" id="signup_form" class="signup_form d-none">
            <h4>Inscrivez-vous <br>
                à l’évènement <br>
                & recevez votre badge
            </h4>
            <div class="form-row mt-4">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Nom et Prénom" required>
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control input-fixer" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="form-group select">
                <div class="form-group">
                    <select id="inputNiveau" name="inputNiveau" class="form-control input-fixer">
                        <option value="Default" selected>Vous êtes?</option>
                        <option value="Etudiant">Etudiant</option>
                        <option value="Lycéen">Lycéen</option>
                        <option value="Jeune">Jeune Diplômé(e)</option>
                        <option value="Parent">Parent</option>
                        <option value="Enseignant">Enseignant</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
            </div>
            <div class="form-group select">
                <div class="form-group">
                    <style>
                        #inputRegion {
                            width: 103%;
                            padding-left: 50px !important
                        }

                        input::placeholder {
                            color: #BBB !important;
                        }
                    </style>
                    <input type="tel" class="form-control input-fixer" name="inputRegion" id="inputRegion" required> <br>
                    <span id="valid-msg" class="hide"></span>
                    <span id="error-msg" class="hide"></span>
                </div>
            </div>
            <center style="margin-top: 20px; margin-bottom: 10px">
                <button type="submit" name="submit_sign_in" class="btn btn-primary">
                    S’inscrire
                </button>
            </center>
            <a href="#" id="goSignIn" class="change_block">Connectez vous</a>
        </form>

        <footer>
            <div class="footer_left">
                <img src="./assets/logos/edufrance.png" alt="edufrance logo">
            </div>
            <div class="footer_right">
                <p class=" font-weight-bold">
                    <img src="./assets/icons/whatsapp.png" alt="whatsup icon"><span class="ml-3">Infoline : +216 56 832 160</span>
                </p>
            </div>
        </footer>
    </div>

    <!-- loader -->
    <style>
        /* LOADER */
        @keyframes ldio-s00q76hkpb {
            0% {
                top: 96px;
                left: 96px;
                width: 0;
                height: 0;
                opacity: 1;
            }

            100% {
                top: 18px;
                left: 18px;
                width: 156px;
                height: 156px;
                opacity: 0;
            }
        }

        .ldio-s00q76hkpb div {
            position: absolute;
            border-width: 4px;
            border-style: solid;
            opacity: 1;
            border-radius: 50%;
            animation: ldio-s00q76hkpb 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }

        .ldio-s00q76hkpb div:nth-child(1) {
            border-color: #e90c59
        }

        .ldio-s00q76hkpb div:nth-child(2) {
            border-color: #46dff0;
            animation-delay: -0.5s;
        }

        .loadingio-spinner-ripple-8qkb06zpvbs {
            width: 400px;
            height: 400px;
            display: inline-block;
            overflow: hidden;
            /* background: #ffffff; */
        }

        .ldio-s00q76hkpb {
            width: 100%;
            height: 100%;
            position: relative;
            transform: translateZ(0) scale(1.5);
            backface-visibility: hidden;
            transform-origin: 0 0;
        }

        .ldio-s00q76hkpb div {
            box-sizing: content-box;
        }

        #loader {
            position: absolute;
            top: 20%;
            left: 40%;
        }
    </style>
    <div class="loadingio-spinner-ripple-8qkb06zpvbs" id="loader">
        <div class="ldio-s00q76hkpb">
            <div></div>
            <div></div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="./node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <!--===============================================================================================-->
    <script>
        var input = document.querySelector("#inputRegion"),
            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg");

        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                try {
                    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback(countryCode);
                    });
                } catch (err) {
                    console.log("failed+error=" + err)
                }

            },
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/utils.js"
        });

        var reset = function() {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };
        if ($("#valid-msg").hasClass('hide')) {
            $(this).hide();
        }
        input.addEventListener('change', function() {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");
                } else {
                    validMsg.innerHTML = "";
                    input.classList.add("error");
                    var errorCode = iti.getValidationError();
                    if (errorMap[errorCode])
                        Swal.fire(
                            'Oops!',
                            'Le numéro de téléphone est invalide!',
                            'warning'
                        )
                    errorMsg.classList.remove("hide");
                }
            }
        });

        input.addEventListener('keyup', reset);
        /*===============================================================================================*/
        $(document).ready(function() {
            //async site status call
            const block_changer = (selectorHide, selectorShow, btnFirst, btnSecond) => {
                $(selectorHide).hide();
                $(selectorShow).removeClass('d-none');
                $(btnFirst).click(function() {
                    $(selectorHide).fadeToggle();
                    setTimeout(() => {
                        $(selectorHide).addClass('d-none');
                        $(selectorShow).removeClass('d-none').fadeToggle();
                    }, 500);
                })
                $(btnSecond).click(function() {
                    $(selectorShow).fadeToggle();
                    setTimeout(() => {
                        $(selectorShow).addClass('d-none');
                        $(selectorHide).removeClass('d-none').fadeToggle();
                    }, 500);
                })
            }

            function getStatus() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        method: 'post',
                        url: './handlers/siteStatus.php',
                        success: function(response) {
                            resolve(response);
                        },
                        error: function(error) {
                            reject(error.getAllResponseHeaders());
                        }
                    });
                })
            }

            async function siteStatus() {
                try {
                    const response = await getStatus();
                    if (response == 0)
                        block_changer('.signin_form', '.signup_form', '#goSignUp', '#goSignIn')
                    else if (response == 1)
                        block_changer('.signup_form', '.signin_form', '#goSignIn', '#goSignUp')
                    // console.log(response);
                } catch (err) {
                    console.log(err);
                }
            }
            siteStatus();

            $('.all-content').hide();
            $('#loader').show();
            setTimeout(() => {
                $('#loader').fadeToggle();
                $('.all-content').fadeToggle();
            }, 300);

            //login handling
            $("form[name='signin_form']").submit(function(e) {
                e.preventDefault();
                var email = $('#this_is_an_username').val();
                var phone = $('#this_is_a_phone').val();
                $.ajax({
                    url: './handlers/form_handlers/signInHandler.php',
                    method: 'post',
                    data: {
                        phone: phone,
                        email: email
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire(
                                'Succès!',
                                '',
                                'success'
                            )
                            $('#loader').fadeToggle();
                            $('.all-content').fadeToggle();
                            setTimeout(function() {
                                $('#loader').fadeToggle();
                                window.location.replace("./views/home.php");
                            }, 1000);
                        } else if (response == 0) {
                            //password is wrong
                            Swal.fire(
                                'Alert!',
                                'Email ou Numéro du téléphone invalid',
                                'error'
                            )

                            Swal.fire(
                                'Numéro du téléphone format!',
                                "'+'+code de pays+Numéro du téléphone (exemple +000111111111 )",
                                'info'
                            )
                        } else {
                            //email is wrong
                            Swal.fire(
                                'Alert!',
                                'Email ou Mot de pass invalid',
                                'error'
                            )
                        }
                    }
                })
            })


            function mail_user(mail_to) {
                sender = "no-reply@admin.utfam.com";
                message = "18 Avril : Journée Porte Ouvertes Virtuelle <br>Votre inscription est bien enregistrée!<br>Vous êtes désormais inscrit(e) et vous recevrez votre badge très bientôt.";
                $('.lds-dual-ring').fadeToggle();
                let timerInterval
                Swal.fire({
                    title: 'Email envoyer!',
                    html: '<b>Voir votre boîte de réception dans</b> milliseconds.',
                    timer: 3000,
                    timerProgressBar: true,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                        timerInterval = setInterval(() => {
                            const content = Swal.getContent()
                            if (content) {
                                const b = content.querySelector('b')
                                if (b) {
                                    b.textContent = Swal.getTimerLeft()
                                }
                            }
                        }, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {

                    }
                })
                $.ajax({
                    url: './handlers/form_handlers/mailSend.php',
                    method: 'post',
                    data: {
                        message: message,
                        mail_from: sender,
                        mail_to: mail_to
                    },
                    success: function(response) {
                        /*
                        $('#mail_input').removeAttr('value');
                        $('#mailSent').fadeToggle();
                        setTimeout(() => {
                            $('#mailSent').fadeToggle();
                            // window.location.replace("./views/home.php");
                        }, 2000);*/
                    },
                    complete: function() {
                        $('.lds-dual-ring').fadeToggle();
                        window.location.replace("./views/home.php");
                    },
                    error: function(error) {
                        console.log(error.getAllResponseHeaders());
                    }
                })
            }
            //sign up handling
            $("form[name='signup_form']").submit(function(e) {
                e.preventDefault();
                var f_name = $('#full_name').val();
                var email = $("#email").val();
                var niveau = $('#inputNiveau option:selected').text();
                const phoneNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                const countryData = iti.getSelectedCountryData();
                const countryName = countryData.name;
                const countryIso = countryData.iso2;
                const dialCode = countryData.dialCode;

                reset();
                if (input.value.trim()) {
                    if (iti.isValidNumber()) {
                        validMsg.classList.remove("hide");
                    } else {
                        validMsg.innerHTML = "";
                        input.classList.add("error");
                        var errorCode = iti.getValidationError();
                        if (errorMap[errorCode])
                            Swal.fire(
                                'Oops!',
                                'Le numéro de téléphone est invalide!',
                                'warning'
                            )
                        return;
                        errorMsg.classList.remove("hide");
                    }
                }
                //checking if email existence
                if ($('#inputNiveau option:selected').val() == "Default") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alert',
                        text: ' Veuillez sélectionner un niveau!',
                    })
                } else {
                    $.ajax({
                        url: './handlers/form_handlers/checkExist.php',
                        method: 'post',
                        data: {
                            email: email
                        },
                        success: function(response) {
                            if (response == 1) { //exist
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Alert',
                                    text: 'Email déjà exist!',
                                })
                            } else { //not exist
                                $.ajax({
                                    url: './handlers/form_handlers/signUpHandler.php',
                                    method: "post",
                                    data: {
                                        f_name: f_name,
                                        email: email,
                                        niveau: niveau,
                                        phoneNumber: phoneNumber,
                                        countryName: countryName,
                                        countryIso: countryIso,
                                        dialCode: dialCode
                                    },
                                    success: function(response) {
                                        $('#loader').fadeToggle();
                                        $('.all-content').fadeToggle();
                                        Swal.fire(
                                            'Succès!',
                                            ' Merci de vous inscrire!',
                                            'success'
                                        )
                                        setTimeout(function() {
                                            $('#loader').fadeToggle();
                                            mail_user(email);
                                        }, 4000);
                                    },
                                    error: function(error) {
                                        console.log(error.getAllResponseHeaders());
                                    }
                                })
                            }
                        }
                    })
                }
            });
        })
    </script>
</body>

</html>