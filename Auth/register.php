<?php
//    include_once('classes/auth.class.php');
//    $contact = new Auth();
//    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
//        $create = $contact->authAdmin($_POST);
//    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BACK-BONE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../layouts/bootstrap/login/images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href=../layouts/bootstrap/login/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../layouts/bootstrap/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../layouts/bootstrap/login/vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="../layouts/bootstrap/login/vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="../layouts/bootstrap/login/vendor/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="../layouts/bootstrap/login/css/util.css">
        <link rel="stylesheet" type="text/css" href="../layouts/bootstrap/login/css/main.css">
    </head>
    <body class="bg-light">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="../layouts/bootstrap/login/images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="" method="post">
                            <span class="login100-form-title">
                                Registration
                            </span>
                    <?php
                    //                    if (isset($create)) {
                    //                        echo $create;
                    //                    }
                    ?>
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Name">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Confirm Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>


                    <div class="container-login100-form-btn">
                        <button type="submit" name="login" class="login100-form-btn">
                            Register
                        </button>
                    </div>


                    <div class="text-center p-t-136">
                        <a class="txt2" href="#">
                            Powerd by <strong>BACK-BONE</strong>
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../layouts/bootstrap/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../layouts/bootstrap/login/vendor/bootstrap/js/popper.js"></script>
    <script src="../layouts/bootstrap/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../layouts/bootstrap/login/vendor/select2/select2.min.js"></script>
    <script src="../layouts/bootstrap/login/vendor/tilt/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="l../layouts/bootstrap/login/js/main.js"></script>
    </body>
</html>
