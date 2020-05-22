<?php
include "../handlers/session_handlers/sessionStarter.php";
include "config.php";

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

//getting url
$url = $user->getStreamUrl();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="./assets/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="../assets/loader/loading-bar.css">
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="../assets/css/template.css"> -->
    <!--===============================================================================================-->
    <link rel="stylesheet" href="../node_modules/jquery-ui-1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="../node_modules/jquery-ui-1.12.1/jquery-ui.structure.css">
    <link rel="stylesheet" href="../node_modules/jquery-ui-1.12.1/jquery-ui.theme.css">
    <link rel="stylesheet" href="../assets/css/chat_app.css">
    <!--===============================================================================================-->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!--===============================================================================================-->
    <style>
        /* body {
            overflow: scroll !important;
        } */
    </style>
</head>

<body>
    <style>
        button[name="logout"] {
            position: absolute;
            top: 0%;
            left: 0%;
            z-index: 123456
        }
    </style>
    <div class="all-content">
        <form method="POST" action="home.php" id="logoutForma">
            <button href="#" class="btn btn-primary" data-toggle="tooltip" title="Déconnexion" name="logout">
                <i class="fas fa-sign-out-alt" style="transform: rotate(180deg);"></i>
            </button>
        </form>
    </div>

    <style>
        section.banner {
            background: black;
            height: 150px;
            width: 80vw
        }
    </style>

    <section class="banner">

    </section>

    <section class="conf">
        <div class="video_wrapper">
            <iframe src="<?= $url ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </section>

    <div class="loadingio-spinner-ripple-8qkb06zpvbs" id="loader">
        <div class="ldio-s00q76hkpb">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- emty message warning -->
    <div class="alert alert-warning animated" role="alert" id="emptyMessage">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Alerte!</h4>
        Vous ne pouvez pas envoyer un message vide.
    </div>

    <!--===============================================================================================-->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <!--===============================================================================================-->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <!--===============================================================================================-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!--===============================================================================================-->
    <script src="../assets/bootstrap/js/popper.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/tilt/tilt.jquery.min.js"></script>
    <!--===============================================================================================-->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/loader/loading-bar.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/js/script.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/js/chat_app.js"></script>
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <!--===============================================================================================-->
    <!-- 
    <div class="flex-row-rev" style="justify-content: flex-start">
        <div id="container_chat_1" class="col-md-3 container_chat">
        </div>
        <div id="container_chat_2" class="col-md-3 container_chat">
        </div>
        <div id="container_chat_3" class="col-md-3 container_chat">
        </div>
        <div id="container_chat_4" class="col-md-3 container_chat">
        </div>
        <div id="container_chat_5" class="col-md-3 container_chat">
        </div>
    </div> -->
    <!-- <a href="#" id="toggle_message_app" class="message_toggle">toggle</a> -->
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
        }

        .has-search input {
            border: 1px solid transparent;
            border-bottom: 5px solid #4545a5;
            -webkit-box-shadow: 0px 0px 4px -2px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 4px -2px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 0px 4px -2px rgba(0, 0, 0, 0.75);
        }

        body {
            overflow: hidden !important;
        }

        .wrapper_chat_box,
        .draggableContainer {
            position: absolute !important;
        }
    </style>
    <div class="btn_toggle_chat">
        <a href="#" class="btn btn-primary" data-toggle="tooltip" title="Chat" id="btn_mobile_toggle">
            <i class="fas fa-comment-dots"></i>
        </a>
    </div>
    <div class="top_wrapper_message hide">
        <div id="drag_message_app">
            <div class="wrapper_chat_box expand">
                <div class="container">
                    <div class="flex-row-rev" id="users_column">
                        <div class="users_column_top">
                            <div class="users_column_top_details font-weight-bold">
                                <h4 style="margin-left: 0%;margin-top: 5px;">Chat</h4>
                            </div>
                            <div class="hideChat_mobile">
                                <a href="#" id="hideChat_mobile_btn" data-toggle="tooltip" title="Reduit" class="btn btn-primary">
                                    <i class="fas fa-minus-square"></i>
                                </a>
                            </div>
                            <!-- <div class="expand_box">
                                <a href="#" class="btn btn-primary btn-block btn-sm" id="expand_chat">
                                    <i class="fas fa-chevron-circle-up" style="transition: all .5s cubic-bezier(0.645, 0.045, 0.355, 1);transform: rotate(180deg)"></i>
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper_chat_messages expand active">
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
                            <i class="fas fa-times"></i>
                        </a>
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
            <div class="draggableContainer" id="draggableContainer">
                <a id="dragMe" class="draggable">
                    <div class="liquid"></div>
                    <span>Chat</span>
                </a>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer_wrapper">

        </div>
    </footer>
</body>
<script>
    $(document).ready(function() {
        $('#hideShowTopBar').click(function() {
            $('.user_info').toggleClass('visible')
        })
        $('.draggable').bind('click', function() {
            if ($(this).hasClass('ui-draggable-dragging')) {
                return false;
            }
        });
        $('.draggable').draggable({
            scroll: false,
            revert: 'invalid',
        })

        $('#dragMe').click(function() {
            if ($('.wrapper_chat_box').hasClass('active')) {
                //message changes
                $('.wrapper_chat_box').show().removeClass('d-none');
                $('.wrapper_chat_box').removeClass('active collapse-bottom-right')
                $('.wrapper_chat_box').css({
                    "transition": " all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                }).addClass('expand-bottom-right')
                //body adaptation
                $('section.banner').css({
                    "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                    'width': ''
                })

                $('section.conf').css({
                    "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                    'width': ''
                })

                $('section.conf .video_wrapper').css({
                    "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                    'padding': ''
                })

                $('section.conf .video_wrapper').css({
                    "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                    'height': '',
                    'width': ''
                })
            } else {
                if ($('.wrapper_chat_messages').hasClass('hidden')) {
                    if ($('.user_info').hasClass('visible'))
                        $('.user_info').toggleClass('visible')
                    setTimeout(() => {
                        $('.wrapper_chat_messages').css({
                            "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                            'right': '-30%'
                        }).removeClass('hidden');
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

                        //body adaptation
                        $('section.banner').css({
                            "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                            'width': '100%'
                        })

                        $('section.conf').css({
                            "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                            'width': '100%'
                        })

                        $('section.conf .video_wrapper').css({
                            "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                            'padding': '20%'
                        })

                        $('section.conf .video_wrapper').css({
                            "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                            'height': '94%',
                            'width': '97%'
                        })
                    }, 400);
                }
            }
        });

        $(document).on('click', '#button_resizer', function() {
            if (window.innerWidth <= 500) {
                if ($('.wrapper_chat_messages').hasClass('hidden'))
                    $('.wrapper_chat_messages').css({
                        "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                        'right': '-100%'
                    }).removeClass('hidden');
            } else {
                if ($('.wrapper_chat_messages').hasClass('hidden'))
                    $('.wrapper_chat_messages').css({
                        "transition": "all .5s cubic-bezier(0.645, 0.045, 0.355, 1)",
                        'right': '-30%'
                    }).removeClass('hidden');
            }
        })

        $(document).on('click', '#user_row', function() {
            if (window.innerWidth <= 500) {
                right = '0%';
            } else {
                if ($('.wrapper_chat_messages').hasClass('expand'))
                    right = '22%';
                else
                    right = '26.3%';
            }

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
                    'right': '26.3%',
                    'top': '43%'
                })
            } else {
                $('.wrapper_chat_messages').css({
                    'right': '22%',
                    'top': ''
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

        //media queries
        $('#btn_mobile_toggle').click(function() {
            if ($('.top_wrapper_message').hasClass('hide')) {
                $('.top_wrapper_message').removeClass('hide').addClass('active')
            } else {
                $('.top_wrapper_message').addClass('hide').removeClass('active')
            }
        })

        $('#hideChat_mobile_btn').click(function() {
            if ($('.top_wrapper_message').hasClass('hide')) {
                $('.top_wrapper_message').removeClass('hide').addClass('active')
            } else {
                $('.top_wrapper_message').addClass('hide').removeClass('active')
            }
        })
        setInterval(() => {
            if (!$('.top_wrapper_message').hasClass('active')) {
                if (window.innerWidth <= 500) {
                    $('.top_wrapper_message').addClass('hide');
                    $('.wrapper_chat_messages ').removeClass('expand');
                } else {
                    $('.top_wrapper_message').removeClass('hide');
                    $('.wrapper_chat_messages ').addClass('expand ');
                }
            }
        }, 1000);
    })

    /*===========*home chat goes here*===========*/
    // window.history.forward();
    $('.all-content').hide();
    $('#emptyMessage').hide();
    $('#loader').show();
    setTimeout(() => {
        $('#loader').fadeToggle();
        $('.all-content').fadeToggle();
    }, 300);

    window.onload = () => {

        var users = [];
        var users_color = [];
        var unread_users = [];

        function fetchAllOnlineUsers(users_unread) {
            $.ajax({
                url: '../handlers/home_handlers/getAllOnlineUsers.php',
                method: 'post',
                success: function(response) {
                    if (response != 0) {
                        data = jQuery.parseJSON(response);
                        for (let i = 0; i < data.length; i++) {
                            if (data[i].user_logged == "yes") {
                                color = "#39ff00";
                            } else {
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
                                //removeNoneSpokenWith: 'yes'
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

        //getting user color
        const userColor = (username) => {
            $.ajax({
                url: '../handlers/home_handlers/getUserColor.php',
                method: 'post',
                data: {
                    username: username
                },
                success: function(response) {
                    return response;
                },
                error: function(response) {
                    alert(error.getAllResponseHeaders());
                }
            })
        }
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
                                user_color = userColor(username);
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
        $('#post_message').on('click', function(e) {
            e.preventDefault();
            var msg = $('#input_message_content').val();
            var sender = '<?= $_SESSION["username"] ?>';
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
                            $('#input_message_content').val('');
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
                        updateUserColor();

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
                // $('.users_column_top').after('<?= $output ?>');
                // nothing = [];
                // fetchAllOnlineUsers(nothing)
                // fetchUnreadMessages();
                // return;
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
</script>

</html>