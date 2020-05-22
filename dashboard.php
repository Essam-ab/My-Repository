<?php
include "./classes/db.php";
include "./classes/user.php";
include "./handlers/session_handlers/sessionStarter.php";
$user = new User();
$users = $user->getAllUsers();
$output = "";
foreach ($users->fetchAll(PDO::FETCH_OBJ) as $val) {
    $output .= '<tr><th scope=\'row\'>' . $val->use_id . '</th><td>' . $val->use_username . '</td> <td>' . $val->use_email . '</td><td>' . $val->use_country . '</td><td>' .  $val->use_whatsup . '</td><td>' . $val->use_niveau . '</td></tr>';
}

$query = $user->getUserColor($_SESSION['username']);
foreach ($query->fetchAll(PDO::FETCH_OBJ) as $val)
    $userColorInSession = $val->use_color;

if (isset($_POST['logout'])) {
    include  "./handlers/session_handlers/sessionDestroyer.php";
    header("location: ./index.php?loggedOut");
    exit();
}
$users = $user->getAllOnlineOfflineUsers($_SESSION['username']);
$output = "";
foreach ($users->fetchAll(PDO::FETCH_OBJ) as $val) {
    if ($val->user_logged == "yes") {
        $color = "#39ff00";
    } else {
        $color = "red";
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Edufrance | Dashboard</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/fontawesome.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./assets/initTelInput/css/intlTelInput.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="./assets/initTelInput/css/intlTelInput.min.css">
    <!--===============================================================================================-->
    <style>
        td,
        th {
            padding: .55rem !important;
        }
    </style>
</head>

<body data-gr-c-s-loaded="true">
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar active" style="overflow: visible;">
            <div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0">
                <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                    <div class="sidebar-header">
                        <h3 class="text-center">Edufrance</h3>
                    </div>

                    <ul class="list-unstyled components">
                        <p class="text-black-50 text-center">Menu</p>
                        <li class="active">
                            <a href="./dashboard.php" data-toggle="collapse" aria-expanded="false"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="">
                            <a href="./views/addUrl.php" aria-expanded="false"><i class="fas fa-pen-square"></i> Url</a>
                        </li>
                    </ul>

                    <ul class="list-unstyled CTAs">
                        <li>
                            <style>
                                button.logout {
                                    background: linear-gradient(45deg, #fba2a4, #ff7ea1) !important;
                                    border: transparent;
                                    color: #fff !important;
                                    width: 100%;
                                    padding: 10px;
                                    border-radius: 5px;
                                    margin-bottom: 20px;
                                    cursor: pointer;
                                }

                                button.logout:hover {
                                    background: linear-gradient(45deg, #fa8058, #fe386b) !important;
                                    color: #fff !important;
                                }

                                a.article {
                                    text-align: center !important;
                                }

                                select,
                                input {
                                    border-radius: 5px !important;
                                }
                            </style>
                            <form method="POST" action="dashboard.php">
                                <button type="submit" class="logout" name="logout">
                                    <i class="fas fa-sign-out-alt" style="transform: rotate(180deg);"></i> Logout
                                </button>
                            </form>
                            <a href="./views/home.php" class="article">Back to Website</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: none;">
                <div class="mCSB_draggerContainer">
                    <div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; height: 0px; top: 0px;">
                        <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                    </div>
                    <div class="mCSB_draggerRail"></div>
                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="active">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <svg class="svg-inline--fa fa-align-left fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="align-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M288 44v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16zM0 172v40c0 8.837 7.163 16 16 16h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16zm16 312h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm256-200H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z"></path>
                        </svg><!-- <i class="fas fa-align-left"></i> -->
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <svg class="svg-inline--fa fa-align-justify fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="align-justify" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M0 84V44c0-8.837 7.163-16 16-16h416c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16zm16 144h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0-128h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
                        </svg><!-- <i class="fas fa-align-justify"></i> -->
                    </button>

                    <style>
                        #search_form {
                            margin-top: 15px;
                            margin-left: 5%;
                        }

                        select,
                        form#search_form {
                            margin-right: 20px;
                        }
                    </style>

                    <form class="input-group md-form form-sm form-1 pl-0" id="search_form">
                        <input type="text" class="form-control my-0 py-1 search" placeholder="Recherche par Nom ou Prénom" aria-label="Search" name="" id="Search">
                    </form>
                    <style>
                        input#inputRegion {
                            width: 15vw !important;
                            margin-right: 20px !important;
                        }
                    </style>
                    <select id="inputRegion" name="inputRegion" class="form-control input-fixer">
                        <option value="default" selected>Tout Pay</option>
                        <option value="United States">United States</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                    <select id="inputNiveau" name="inputNiveau" class="form-control input-fixer">
                        <option value="Default" selected>Tout Niveau</option>
                        <option value="Etudiant">Etudiant</option>
                        <option value="Lycéen">Lycéen</option>
                        <option value="Jeune">Jeune Diplômé(e)</option>
                        <option value="Parent">Parent</option>
                        <option value="Enseignant">Enseignant</option>
                        <option value="Autre">Autre</option>
                    </select>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <style>
                                    #show_chat {
                                        padding: 10px 20px;
                                        font-size: 16px;
                                        color: #ffffff;
                                    }

                                    #show_chat i {
                                        margin-left: 10px;
                                    }
                                </style>
                                <a class="nav-link btn btn-info" href="#" class="" id="show_chat">
                                    Chat<i class="fas fa-comments"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom et Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Pay</th>
                        <th scope="col">WhatsUp</th>
                        <th scope="col">Niveau</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    <style>
                        a i {
                            color: white;
                        }
                    </style>
                    <!-- <?= $output ?> -->
                </tbody>
            </table>

        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <h4 class="modal-title text-center mt-5 ">Send Mail To</h4>
                <p style="margin-top:-30px"></p>
                <div class="modal-body">
                    <style>
                        textarea {
                            width: 100%
                        }
                    </style>
                    <form action="" method="POST" id="send_mail_form">
                        <input type="email" class="form-control" id="mail_name" name="mail_name" placeholder="Votre email" required> <br>
                        <textarea class="form-control" id="mail_input" name="mail_input" value="" placeholder="Message ici" required></textarea>
                        <button class="btn btn-primary form-control" type="submit" name="send_mail" id="send_mail">Envoyer</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- flash messages here -->
    <style>
        #errorMsg,
        #incorrectCred,
        #successMsg,
        #successAdded,
        #successPassed,
        #warningCancel,
        #successSignup,
        #emailExist,
        #usernameExist,
        #loggedStand,
        #loggedOutStand,
        #emptyMessage,
        #phoneWrong,
        #mailSent {
            position: fixed !important;
            top: 80%;
            right: 5%;
            width: 20vw;
        }
    </style>
    <!--  Aucun résultat de recherche -->
    <div class="alert alert-danger animated" role="alert" id="emailExist">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Alert!</h4>
        Aucun résultat.
    </div>

    <div class="alert alert-danger animated" role="alert" id="incorrectCred">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Alert!</h4>
        no more data.
    </div>

    <!-- loader -->
    <style>
        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
            margin-left: 50%;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid black;
            border-color: black transparent black transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="lds-dual-ring" id="scroll_load"></div>
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

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <!--===============================================================================================-->
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="./node_modules/jquery-ui-1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="./node_modules/jquery-ui-1.12.1/jquery-ui.structure.css">
    <link rel="stylesheet" href="./node_modules/jquery-ui-1.12.1/jquery-ui.theme.css">-->
    <link rel="stylesheet" href="./assets/css/chat_app.css">
    <!--===============================================================================================-->
    <!-- <script src="./node_modules/jquery/dist/jquery.min.js"></script> -->
    <!-- <script src="./node_modules/jquery-ui-1.12.1/jquery-ui.min.js"></script> -->
    <!--===============================================================================================-->
    <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!--===============================================================================================-->
    <script src="./node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <!--===============================================================================================-->
    <style>
        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
            transform: scale(.5);
        }

        .has-search input {
            border: 1px solid transparent;
            border-bottom: 5px solid #4545a5;
            -webkit-box-shadow: 0px 0px 4px -2px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 4px -2px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 0px 4px -2px rgba(0, 0, 0, 0.75);
        }

        .user_tag_left i {
            transform: translate(1.5vw, -6vh) !important;
        }
    </style>

    <div class="top_wrapper_message">
        <div id="drag_message_app">
            <div class="wrapper_chat_box expand">
                <a href="#" class="active" id="hide_chat" style="
                    position: absolute;
                    left: 20%;
                    top: 1%;
                    font-size: 20px;
                    color: #3887e3;
                ">
                    Masquer le Chat <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
                <div class="container" style="margin-top: 15%;">
                    <div class="flex-row-rev" id="users_column">
                        <div class="users_column_top">
                            <div class="users_column_top_details font-weight-bold">
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input style="width: 102%;" type="text" class="form-control" placeholder="Search" id="search_user">
                                </div>
                            </div>
                            <div class="expand_box">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper_chat_messages expand active" style="right: -30%">
                <div class="header_chat_messages active animated">
                    <div class="header_messages_left">
                        <div class="chat_user_image">
                            Y
                            <i class="fas fa-circle"></i>
                        </div>
                        <h4>
                            Username <br>
                            <span>
                                Online
                            </span>
                        </h4>
                    </div>
                    <div class="header_messages_right">
                        <a class="btn btn-primary btn-sm" id="button_resizer">
                            <!-- <i class="fas fa-external-link-square-alt"></i> -->
                            <i class="fas fa-times"></i>
                        </a>
                        <!-- <a href="#" class="btn btn-primary" id="toggle_user_info">
                            <i class="fas fa-info-circle"></i>
                        </a> -->
                    </div>
                </div>
                <div class="body_chat_messages">
                </div>
                <div class="resizers_container">
                    <div class="resizer ne">
                        <a class="btn btn-primary btn-sm" id="button_resizer"><i class="fas fa-external-link-square-alt"></i></a>
                    </div>
                    <!-- <div class="resizer nw">
                        <a class="btn btn-primary btn-sm" id="button_resizer"><i class="fas fa-external-link-square-alt"></i></a>
                    </div> -->
                    <div class="resizer se">
                        <a href="#" class="btn btn-primary btn-sm" id="button_resizer"><i class="fas fa-external-link-square-alt"></i></a>
                    </div>
                    <div class="resizer sw">
                        <a href="#" class="btn btn-primary btn-sm" id="button_resizer"><i class="fas fa-external-link-square-alt"></i></a>
                    </div>
                    <!-- <div class="resizer bot">
                        <a href="#" class="" id="hideShowTopBar">
                            <i class="fas fa-chevron-circle-down"></i>
                        </a>
                    </div> -->
                </div>
                <div class="footer_chat_messages">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="input_message_content" placeholder="Write a message.." aria-label="Recipient's username" aria-describedby="post_message">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="post_message">
                                    <i class="fas fa-paper-plane" style="font-size: 20px;"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="user_info" id="user_info">
                <div class="user_info_settings">
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
                <div class="chat_user_image">
                    Y
                </div>
                <div class="user_info_name">
                    <h6>Username</h6>
                </div>
                <div class="user_info_description">
                    <p>Lorem ipsum dolor...</p>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // starting flash message
        $('#successAdded').hide();
        $('#phoneWrong').hide();
        $('#successMsg').hide();
        $('#errorMsg').hide();
        $('#successPassed').hide();
        $('#successSignup').hide();
        $('#incorrectCred').hide();
        $('#emailExist').hide();
        $('#usernameExist').hide();
        $('#scroll_load').hide();

        //chat style process
        $(document).ready(function() {
            //$('.wrapper_chat_box').hide()
            $('#dragMe').click(function() {
                if ($('.wrapper_chat_box').hasClass('active')) {
                    $('.wrapper_chat_box').show().removeClass('d-none');
                    $('.wrapper_chat_box').removeClass('active collapse-bottom-right')
                    $('.wrapper_chat_box').css({
                        "transition": " all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                    }).addClass('expand-bottom-right')
                } else {
                    if ($('.wrapper_chat_messages').hasClass('hidden')) {
                        if ($('.user_info').hasClass('visible'))
                            $('.user_info').toggleClass('visible')
                        setTimeout(() => {
                            $('.wrapper_chat_messages').css({
                                "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                                'right': '-30%'
                            }).addClass('hidden');
                        }, 200);
                        setTimeout(() => {
                            $('.wrapper_chat_box').removeClass('expand-bottom-right')
                            $('.wrapper_chat_box').css({
                                "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                            }).addClass('active collapse-bottom-right');
                            setTimeout(() => {
                                $('.wrapper_chat_box').hide().addClass('d-none');
                            }, 400);
                        }, 500);
                    } else {
                        $('.wrapper_chat_box').removeClass('expand-bottom-right')
                        $('.wrapper_chat_box').css({
                            "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                        }).addClass('active collapse-bottom-right');
                        setTimeout(() => {
                            $('.wrapper_chat_box').hide().addClass('d-none');
                        }, 400);
                    }
                }
            });

            $(document).on('click', '#button_resizer', function() {
                if ($('.wrapper_chat_messages').hasClass('hidden'))
                    $('.wrapper_chat_messages').css({
                        "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                        // 'z-index': '-1',
                        'right': '-30%'
                    }).removeClass('hidden');
            })

            $(document).on('click', '#user_row', function() {
                right = '26.3%';
                if ($('.wrapper_chat_messages').hasClass('expand'))
                    right = '20%';
                // right = '22.3%';
                else
                    right = '24%';

                if (!$('.wrapper_chat_messages').hasClass('hidden'))
                    $('.wrapper_chat_messages').css({
                        "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                        'z-index': '123',
                        'right': right
                    }).addClass('hidden');
            })

            $(document).on('click', '#user_row.not_found', function() {
                $('#user_row.not_found').off('click');
                $('.wrapper_chat_messages').css({
                    "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                    'z-index': '-1',
                    'right': '-30%'
                }).removeClass('hidden');
            });

            $("#expand_chat").on('click', function() {
                if ($('.wrapper_chat_messages').hasClass('expand')) {
                    $('.wrapper_chat_messages').css({
                        // 'right': '26.3%',
                        'right': '24%',
                        'top': '43%'
                    })
                } else {
                    $('.wrapper_chat_messages').css({
                        'right': '20%',
                        'top': ''
                        // 'right': '24%',
                        // 'top': '43%'
                    })
                }
                if (($('.wrapper_chat_messages').hasClass('expand') || $('.wrapper_chat_box').hasClass('expand')) && !$('[name="user_row"]').hasClass('active')) {
                    $('.wrapper_chat_messages').css({
                        "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                        'right': '-30%'
                    });
                } else if ((!$('.wrapper_chat_messages').hasClass('expand') || !$('.wrapper_chat_box').hasClass('expand')) && !$('[name="user_row"]').hasClass('active'))
                    $('.wrapper_chat_messages').css({
                        "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                        'right': '-30%'
                    });
                if ($('.user_info').hasClass('visible'))
                    $('.user_info').toggleClass('visible')
                if ($('.wrapper_chat_box').hasClass('expand')) {
                    $('.wrapper_chat_messages').css({
                        "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                        'bottom': '',
                    }).removeClass('expand')
                    $('#user_info').css({
                        'top': '45%',
                        'right': '31%'
                    })
                    $('.wrapper_chat_box').removeClass('expand').css("border-radius", "0px");
                    $(this).html('<i class="fas fa-chevron-circle-up" style="transition: all .5s cubic-bezier(0.645, 0.045, 0.355, 1);transform: rotate(0deg)"></i>')
                } else {
                    $('.wrapper_chat_messages').css({
                        "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                        'bottom': '0',
                    }).addClass('expand')
                    $('#user_info').css({
                        'top': '',
                        'right': ''
                    })

                    $('.wrapper_chat_box').addClass('expand').css("border-radius", "0px");
                    $(this).html('<i class="fas fa-chevron-circle-up" style="transition: all .5s cubic-bezier(0.645, 0.045, 0.355, 1);transform: rotate(180deg)"></i>')
                }
            })

            $('#hide_chat').on('click', function() {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active')
                    $('.wrapper_chat_box').css({
                        'right': '-50%'
                    })

                    $('#show_chat').addClass('active')
                } else {
                    $(this).addClass('active')
                    $('.wrapper_chat_box').css({
                        'right': ''
                    })
                    $('#show_chat').removeClass('active')
                }
            })

            $('#show_chat').on('click', function() {
                $('#hide_chat').addClass('active')
                $('.wrapper_chat_box').css({
                    'right': ''
                })
                $(this).removeClass('active')
            })
        })

        //chat api process
        window.onload = () => {

            var users = [];
            var users_color = [];
            var unread_users = [];

            function fetchAllOnlineUsers(users_unread) {
                $.ajax({
                    url: './handlers/home_handlers/getAllOnlineUsers.php',
                    method: 'post',
                    data: {
                        auth: true
                    },
                    success: function(response) {
                        if (response != 0) {
                            data = jQuery.parseJSON(response);
                            for (let i = 0; i < data.length; i++) {
                                if (data[i].user_logged == "yes") {
                                    log = "Online";
                                    color = "#39ff00";
                                } else {
                                    log = "Offline";
                                    color = "red";
                                }

                                var background = '#45cbfe';
                                if (data[i].user_color != null) {
                                    background = data[i].user_color;
                                }

                                if (!users.includes(data[i].username) && !unread_users.includes(data[i].username)) {
                                    if (users_unread.length > 0) {
                                        for (let j = 0; j < users_unread.length; j++) {
                                            if (!(data[i].username == status_messages[j])) {
                                                users.push(data[i].username);
                                                output = '<div class="" id="user_row" name="user_row" user_username="' + data[i].username + '"><article class="user_tag"><div class="user_tag_left"><div class="chat_user_image" style="background:' + background + '!important;box-shadow:0px 0px 5px 0px ' + background + ';">' + data[i].username.charAt(0).toUpperCase() + '</div><i class="fas fa-circle" aria-hidden="true" style="color: ' + color + '"></i></div><div class="user_tag_right"><h6>' + data[i].username + '</h6> <br><p>' + data[i].last_message + '</p></div></article></div>';
                                                $('#users_column').append(output);
                                                if (!users.includes(data[i].username))
                                                    users[data[i].username] = data[i].user_color;
                                            }
                                        }
                                    } else {
                                        users.push(data[i].username);
                                        if (!users.includes(data[i].username))
                                            users[data[i].username] = data[i].user_color;
                                        output = '<div class="" id="user_row" name="user_row" user_username="' + data[i].username + '"><article class="user_tag"><div class="user_tag_left"><div class="chat_user_image "style="background:' + background + '!important;box-shadow:0px 0px 5px 0px ' + background + ';">' + data[i].username.charAt(0).toUpperCase() + '</div><i class="fas fa-circle" aria-hidden="true" style="color: ' + color + '"></i></div><div class="user_tag_right"><h6>' + data[i].username + '</h6> <br><p>' + data[i].last_message + '</p></div></article></div>';
                                        $('#users_column').append(output);
                                    }
                                }
                            }
                        } else {
                            $('#users_column').html('<h4 class="text-center mt-5 text-dark">Aucun utilisateur en ligne</h4>');
                        }
                    },
                    error: function(response) {
                        alert(error.getAllHeaders());
                    }
                })
            }

            //fetching not read messages for the active class
            function fetchUnreadMessages() {
                $.ajax({
                    url: './handlers/chat_home_handlers/getLastMessageStatus.php',
                    method: 'post',
                    success: function(response) {
                        if (response != 0) {
                            status_messages = jQuery.parseJSON(response)
                            //loading all online and offline users in stand
                            $.ajax({
                                url: './handlers/home_handlers/getAllOnlineUsers.php',
                                method: 'post',
                                data: {
                                    auth: true
                                    //removeNoneSpokenWith: 'yes'
                                },
                                success: function(response) {
                                    data = jQuery.parseJSON(response);

                                    function clearUsers(index) {
                                        $('.wrapper_chat_box #user_row').remove();
                                    }
                                    other_output = "";
                                    output = "";
                                    for (let i = 0; i < data.length; i++) {
                                        unread = '';
                                        notify = '';
                                        read = false;
                                        for (let j = 0; j < status_messages.length; j++) {
                                            read = false;
                                            if (data[i].username == status_messages[j]) {
                                                unread = "unread";
                                                notify = '<div class="notify_me"><span>1</span><i class="fas fa-circle"></i></div>';
                                            } else {
                                                unread = "";
                                                read = true;
                                            }
                                            if (data[i].user_logged == "yes") {
                                                log = "Online";
                                                color = "greenyellow";
                                            } else {
                                                log = "Offline";
                                                color = "red";
                                            }
                                            var background = '#45cbfe';
                                            if (data[i].user_color != null) {
                                                background = data[i].user_color;
                                            }

                                            // if (!unread_users.includes(data[i].username)) {
                                            clearUsers(1);

                                            if (!read) {
                                                unread_users.push(data[i].username);
                                                loadMessages(data[i].username)

                                                output += '<div class="' + unread + '" id="user_row" name="user_row" user_username="' + data[i].username + '"><article class="user_tag"><div class="user_tag_left"><div class="chat_user_image" style="background:' + background + '!important;box-shadow:0px 0px 5px 0px ' + background + ';">' + data[i].username.charAt(0).toUpperCase() + '</div><i class="fas fa-circle" aria-hidden="true" style="color: ' + color + '!important"></i></div><div class="user_tag_right"><h6>' + data[i].username + '</h6> <br><p>' + data[i].last_message + '</p></div>' + notify + '</article></div>';
                                            } else {
                                                other_output += '<div class="" id="user_row" name="user_row" user_username="' + data[i].username + '"><article class="user_tag"><div class="user_tag_left"><div class="chat_user_image "style="background:' + background + '!important;box-shadow:0px 0px 5px 0px ' + background + ';">' + data[i].username.charAt(0).toUpperCase() + '</div><i class="fas fa-circle" aria-hidden="true" style="color: ' + color + '"></i></div><div class="user_tag_right"><h6>' + data[i].username + '</h6> <br><p>' + data[i].last_message + '</p></div></article></div>';
                                            }

                                            // }
                                        }
                                    }
                                    $(".users_column_top").after(output);
                                    $("#users_column").append(other_output);
                                },
                                error: function(response) {
                                    alert(error.getAllHeaders());
                                }
                            })
                        } else {
                            var nothing = [];
                            fetchAllOnlineUsers(nothing);
                        }
                    },
                    error: function(error) {
                        alert(error.getAllResponseHeaders());
                    }
                })
            }
            fetchUnreadMessages();
            setInterval(function() {
                fetchUnreadMessages();
            }, 5000);
            //updating status when user see the unread message 
            $(document).on('click', '[name="user_row"]', function() {
                var user_color = $(this).find('.chat_user_image').css('backgroundColor');
                $('.header_messages_left .chat_user_image').css({
                    'box-shadow': `0px 0px 8px 0px ${user_color}`,
                    'background': user_color,
                })
                $('[name="user_row"]').removeClass('active').css({
                    'border-left': `15px solid white`,
                    'border-bottom': `2px solid white`,
                })
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active')
                } else {
                    const color = $(this).find('.chat_user_image').css('backgroundColor');
                    $(this).css({
                        'border-left': `15px solid ${color}`,
                        'border-bottom': `2px solid ${color}`,
                    })
                    $(this).addClass('active')
                }
            });

            $(document).on('click', '[name="user_row"].unread', function() {
                var sender = $(this).attr('user_username');
                $(this).removeClass('unread');
                $(this).find('.notify_me').remove();
                unread_users.splice(unread_users.indexOf(sender), 1);
                $.ajax({
                    url: './handlers/chat_handlers/updateMessageStatus.php',
                    method: 'post',
                    data: {
                        sender: sender
                    },
                    success: function(response) {
                        if (response == 1) {
                            // console.log("triggered")
                            fetchUnreadMessages();
                        }
                    },
                    error: function(error) {
                        alert(error.getAllResponseHeaders());
                    }
                })
            })

            //loading all messages
            function loadMessages(username) {
                removeUser = [];
                $.ajax({
                    url: './handlers/chat_home_handlers/getAllMessages.php',
                    method: 'post',
                    data: {
                        username: username
                    },
                    success: function(response) {
                        if (response != 0) {
                            data = jQuery.parseJSON(response)
                            var output = "";
                            for (let i = 0; i < data.length; i++) {
                                // image = '';
                                if (data[i].sender != username) {
                                    user_class = "you_row";
                                    user_pic = data[i].sender.charAt(0).toUpperCase();
                                    /*user_color = '<?= $userColorInSession ?>';*/
                                    user_name = "<?= $_SESSION['username'] ?>";
                                } else {
                                    user_class = "other_row";
                                    user_name = username;
                                    // user_color = userColor(username);
                                    user_color = data[i].sender_color;
                                    $('.header_messages_left .chat_user_image').css({
                                        'box-shadow': '0px 0px 8px 0px' + user_color,
                                        'background': user_color,
                                    })
                                }
                                output += '<div class="body_chat_message_row ' + user_class + '"><div class="row_message_content">' + data[i].content + '<div class="chat_user_image" style="background:' + user_color + '!important;box-shadow:0px 0px 5px 0px ' + user_color + ';">' + user_name.charAt(0).toUpperCase() + '</div></div><small> ' + data[i].date + ' </small></div>';
                            }
                            output += '<div class="body_chat_message_row you_row" id="hidden"><div class="row_message_content">qsidflql jfpoqmsij fqmlijdskq kdjf mqslkdfj sqjmljq ds</div></div>';
                            $('.body_chat_messages').html(output);
                        } else {
                            output = '<div class="body_chat_message_row you_row"><div class="row_message_content">Parlez avec ' + username + ' Allez y, écrivez quelque chose!</div></div> ';
                            $('.body_chat_messages').html(output);
                            removeUser.push(username)

                        }
                    },
                    error: function(response) {
                        alert(error.getAllResponseHeaders());
                    }
                })
            }

            setTimeout(function() {
                $(document).on('click', '[name="user_row"]', function() {
                    //loading messages
                    username = $(this).attr('user_username');
                    $(".header_messages_left h4").html(username);
                    $(".header_messages_left .chat_user_image").html(username.charAt(0).toUpperCase());
                    $(".header_messages_left h4").attr('id', username)
                    loadMessages(username);
                })
            }, 300);

            //posting new messages
            $('#post_message').on('click', function(e) {
                e.preventDefault();
                var msg = $('#input_message_content').val();
                var sender = '<?= $_SESSION["username"] ?>';
                // var sender = session_username;
                var receiver = $(".header_messages_left h4").attr('id');
                if (msg != "") {
                    $.ajax({
                        url: './handlers/chat_handlers/addNewMessage.php',
                        method: 'post',
                        data: {
                            sender: sender,
                            receiver: receiver,
                            msg: msg
                        },
                        success: function(response) {
                            if (response == 1) {
                                $('#input_message_content').val('')
                                loadMessages(receiver);
                            }
                        },
                        error: function(response) {
                            alert(error.getAllResponseHeaders())
                        }
                    })
                } else {
                    Swal.fire(
                        'Oops!',
                        'Vous ne pouvez pas envoyer un message vide..',
                        'info'
                    )
                }
            })

            const updateUserColor = () => {
                setTimeout(() => {
                    $.ajax({
                        url: './handlers/home_handlers/generateUserColor.php',
                        method: 'post',
                        data: {
                            auto: true,
                        },
                        success: function(response) {
                            if (response == 0) {
                                // alert("cant generate user color");
                            }
                        },
                        complete: function() {
                            // updateUserColor();

                        },
                        error: function(error) {
                            alert(error.getAllResponseHeaders());
                        }
                    })
                }, 1000)
            }
            updateUserColor();

            $('#search_user').keyup(function(e) {
                e.preventDefault();
                search = $('#search_user').val();
                if (search == '') {
                    $('.wrapper_chat_box #user_row').remove();
                }
                $('#loader').fadeToggle();
                $.ajax({
                    url: './handlers/chat_handlers/FnameLnameFilter.php',
                    method: 'post',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        if (response == -1)
                            alert("you have no permession to performe such action!");
                        else if (response == 0) {
                            $('.wrapper_chat_box #user_row').remove();
                            $('.users_column_top').after('<div class="not_found" id="user_row" name="user_row" user_username="bak"><h6>nom d\'utilisateur n\'existe pas</h6><article class="user_tag"></article></div>');
                            setTimeout(() => {
                                fetchUnreadMessages();
                            }, 2000);
                        } else {
                            $('.wrapper_chat_box #user_row').remove();
                            $('.users_column_top').after(response);
                        }
                    },
                    complete: function() {
                        $('#loader').fadeToggle();
                    },
                    error: function(error) {
                        console.log(error.getAllResponseHeaders());
                    }
                })
            })

        }

        //dashboard process
        $(document).ready(function() {
            /*===========*sending emails*===========*/
            /*=====================================================================================*/
            mail_to = "";
            $('[name="click_to_mail"]').click(function() {
                alert('working on it')
                mail_to = $(this).attr('id');
                mail_to = "test";
                $('.modal-content p').html('<br>' + mail_to).css('text-align', 'center')
            })

            /*===========*Send mail*===========*/
            /*=====================================================================================*/
            $('#send_mail_form').submit(function(e) {
                e.preventDefault();
                sender = $('[name = "mail_name"]').val();
                message = $('[name = "mail_input"]').val();
                $('.lds-dual-ring').fadeToggle();
                $.ajax({
                    url: './handlers/form_handlers/mailSend.php?mail=' + sender,
                    method: 'post',
                    data: {
                        message: message,
                        mail_from: sender,
                        mail_to: mail_to
                    },
                    success: function(response) {
                        $('#mail_input').removeAttr('value');
                        $('#mailSent').fadeToggle();
                        setTimeout(() => {
                            $('#mailSent').fadeToggle();
                        }, 1000);
                    },
                    complete: function() {
                        $('.lds-dual-ring').fadeToggle();
                    },
                    error: function(error) {
                        console.log(error.getAllResponseHeaders());
                    }
                })
            })

            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            /*===========*Sidebar*===========*/
            /*=====================================================================================*/
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

            /*===========*Filter*===========*/
            /*=====================================================================================*/
            //first and last name
            $('#Search').keyup(function(e) {
                e.preventDefault();
                search = $('.search').val();
                if (search == '') {
                    $('tbody').html("<?= $output ?>");
                    return;
                }
                $('#loader').fadeToggle();
                $.ajax({
                    url: './handlers/filter_handlers/FnameLnameFilter.php',
                    method: 'post',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        if (response == -1)
                            alert("you have no permession to performe such action!");
                        else if (response == 0) {
                            $('#emailExist').fadeToggle();
                            setTimeout(() => {
                                $('#emailExist').fadeToggle();
                                $('option:selected', this).remove();
                            }, 3000);
                        } else {
                            $('tbody').html(response);
                        }
                    },
                    complete: function() {
                        $('#loader').fadeToggle();
                    },
                    error: function(error) {
                        console.log(error.getAllResponseHeaders());
                    }
                })
            })

            //country
            $('#inputRegion').change(function() {
                selected = $('#inputRegion option:selected').text();
                // getCountryInfo();
                // countryName
                // countryIso
                // dialCode
                if (selected == 'Tout Pay') {
                    $('tbody').html("<?= $output ?>");
                    return;
                }
                $('#loader').fadeToggle();
                $.ajax({
                    url: './handlers/filter_handlers/regionFilter.php',
                    method: 'post',
                    data: {
                        // countryName: countryName,
                        // countryIso: countryIso,
                        // dialCode: dialCode,
                        selected: selected
                    },
                    success: function(response) {
                        if (response == -1)
                            alert("you have no permession to performe such action!");
                        else if (response == 0) {
                            $('#emailExist').fadeToggle();
                            setTimeout(() => {
                                $('#emailExist').fadeToggle();
                                $('option:selected', this).remove();
                            }, 3000);
                        } else {
                            $('tbody').html(response);
                        }
                    },
                    complete: function() {
                        $('#loader').fadeToggle();
                    },
                    error: function(error) {
                        console.log(error.getAllResponseHeaders());
                    }
                })
            })

            //level
            $('#inputNiveau').change(function() {
                selected = $('#inputNiveau option:selected').text();
                if (selected == 'Tout Niveau') {
                    $('tbody').html("<?= $output ?>");
                    return;
                }
                $('#loader').fadeToggle();
                $.ajax({
                    url: './handlers/filter_handlers/levelFilter.php',
                    method: 'post',
                    data: {
                        selected: selected
                    },
                    success: function(response) {
                        if (response == -1)
                            alert("you have no permession to performe such action!");
                        else if (response == 0) {
                            $('#emailExist').fadeToggle();
                            setTimeout(() => {
                                $('#emailExist').fadeToggle();
                                $('option:selected', this).remove();
                            }, 1000);
                        } else {
                            $('tbody').html(response);
                        }
                    },
                    complete: function() {
                        $('#loader').fadeToggle();
                    },
                    error: function(error) {
                        console.log(error.getAllResponseHeaders());
                    }
                })
            })

            /*===========*Scroll-load*===========*/
            /*=====================================================================================*/
            var limit = 15;
            var start = 0;
            var action = "inactive";

            function loadUsers(limit, start) {
                // $('#scroll_load').fadeToggle();
                $.ajax({
                    url: './handlers/fetchOnScroll.php',
                    method: 'post',
                    data: {
                        limit: limit,
                        start: start
                    },
                    cache: false,
                    success: function(data) {
                        $('tbody').append(data);
                        if (data = '') {
                            $('#incorrectCred').fadeToggle();
                            setTimeout(() => {
                                $('#incorrectCred').fadeToggle();
                            }, 1000);
                            action = "active";
                        } else {
                            action = "inactive";
                        }
                    },
                    complete: function() {
                        $('#scroll_load').fadeToggle();
                    }
                })
            }

            if (action == "inactive") {
                action = "active";
                $('#loader').fadeToggle();
                loadUsers(limit, start);
            }

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() > $('tbody').height() + 200 && action == "inactive") {
                    action = "active";
                    start += limit;
                    $('#scroll_load').fadeToggle();
                    setTimeout(() => {
                        loadUsers(limit, start);
                    }, 1000);
                }
            })
        });
    </script>


</body>

</html>