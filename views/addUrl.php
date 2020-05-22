<?php
include "../classes/db.php";
include "../classes/user.php";
include "../handlers/session_handlers/sessionStarter.php";
$user = new User();
$query = $user->getUserColor($_SESSION['username']);
foreach ($query->fetchAll(PDO::FETCH_OBJ) as $val)
    $userColorInSession = $val->use_color;

if (isset($_POST['logout'])) {
    include  "../handlers/session_handlers/sessionDestroyer.php";
    header("location: ../index.php?loggedOut");
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
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/fontawesome.min.css"> -->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./assets/initTelInput/css/intlTelInput.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="./assets/initTelInput/css/intlTelInput.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <li>
                            <a href="../dashboard.php" aria-expanded="false"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="active">
                            <a href="./addUrl.php" data-toggle="collapse" aria-expanded="false"><i class="fas fa-pen-square"></i> Url</a>
                        </li>
                    </ul>

                    <ul class="list-unstyled CTAs">
                        <li>
                            <a href="./views/home.php" class="article">Back to Inscription</a>
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

            <div class="document_content">
                <form class="form-inline" id="updateUrl">
                    <style>
                        #inputAddUrl {
                            width: 100%;
                        }
                    </style>
                    <div class="form-group mx-sm-3 mb-2" style="width: 50%;">
                        <input type="text" class="form-control" id="inputAddUrl" name="inputAddUrl" placeholder="Url..." required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2" id="addUrl">Ajouter</button>
                </form>
            </div>
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
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <!--===============================================================================================-->
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="../assets/css/chat_app.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!--===============================================================================================-->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
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
                    right = '22%';
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
                        'right': '22%',
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
            //updating stream url
            const urlPromise = (url) => {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '../handlers/form_handlers/updateUrl.php',
                        method: 'post',
                        data: {
                            url: url
                        },
                        success: function(response) {
                            if (response == 1)
                                resolve(response);
                            else
                                reject(response);
                        },
                        error: function(error) {
                            reject(error);
                        }
                    })
                });
            }

            const updateUrl = async (e, url) => {
                e.preventDefault();
                try {
                    const response = await urlPromise(url);
                    if (response == 1) {
                        Swal.fire(
                            'Success!',
                            "L'Url a été mise à jour.",
                            'success'
                        )
                    } else
                        Swal.fire(
                            'Oops!',
                            'Cant update url..',
                            'error'
                        )
                    document.querySelector('input[name="inputAddUrl"]').value = '';
                } catch (err) {
                    alert(err);
                }
            }

            $('form#updateUrl').submit(function(e) {
                const url = $('[name="inputAddUrl"]').val();
                updateUrl(e, url);
            });

            var users = [];
            var users_color = [];
            var unread_users = [];

            function fetchAllOnlineUsers(users_unread) {
                $.ajax({
                    url: '../handlers/home_handlers/getAllOnlineUsers.php',
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
                    url: '../handlers/chat_home_handlers/getLastMessageStatus.php',
                    method: 'post',
                    success: function(response) {
                        if (response != 0) {
                            status_messages = jQuery.parseJSON(response)
                            //loading all online and offline users in stand
                            $.ajax({
                                url: '../handlers/home_handlers/getAllOnlineUsers.php',
                                method: 'post',
                                data: {
                                    auth: true
                                },
                                success: function(response) {
                                    data = jQuery.parseJSON(response);

                                    function clearUsers(index) {
                                        $('.wrapper_chat_box #user_row').remove();
                                    }
                                    // $('.wrapper_chat_box #user_row').remove();
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
                                                // if ($('.header_messages_left h4').attr('id') == data[i].username && $('#user_row').hasClass('unread'))
                                                loadMessages(data[i].username)
                                                unread_users.push(data[i].username);
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
                    url: '../handlers/chat_handlers/updateMessageStatus.php',
                    method: 'post',
                    data: {
                        sender: sender
                    },
                    success: function(response) {
                        if (response == 1) {
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
                    url: '../handlers/chat_home_handlers/getAllMessages.php',
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
                                    user_color = '<?= $userColorInSession ?>';
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
                        url: '../handlers/chat_handlers/addNewMessage.php',
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
                        url: '../handlers/home_handlers/generateUserColor.php',
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
                            setTimeout(() => {
                                updateUserColor();
                            }, 5 * 60000);
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
                    url: '../handlers/chat_handlers/FnameLnameFilter.php',
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
                    url: '../handlers/form_handlers/mailSend.php?mail=' + sender,
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
                    url: '../handlers/filter_handlers/FnameLnameFilter.php',
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
                if (selected == 'Tout Pay') {
                    $('tbody').html("<?= $output ?>");
                    return;
                }
                $('#loader').fadeToggle();
                $.ajax({
                    url: '../handlers/filter_handlers/regionFilter.php',
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
                    url: '../handlers/filter_handlers/levelFilter.php',
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
                    url: '../handlers/fetchOnScroll.php',
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