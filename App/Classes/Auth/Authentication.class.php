<?php
    session_start();
    include(ROOT_PATH . '/bootstrap/bootstrap.php');
    class Authentication extends  Model
    {
        private static $tableName = "users";
        private static $validatorCheck;
        private static $requestResult;
        private static $successMessage;
        private static $errorMessage;
        private static $makeSession;
        private static $queryString;

        /***
         * @param $request
         * @return string
         * @throws Exception
         * @Register User Method
         */
        public static function registerUser($request)
        {
            $validator = [
                'name'          => ['required', 'min' => 5, 'maxLen' => 150, 'trim'],
                'email'         => ['required', 'email'],
                'password'      => ['required', 'min' => 8, 'trim'],
                'c-password'    => ['required', 'min' => 8]
            ];
            self::$validatorCheck = Validator::coreValidator($request, $validator);
            if (Validator::error()) {
                Validator::errorLoop(Validator::error());
            }else {
                if ($request('c-password') != $request('password')) {
                    $error = "Password does not match try again";
                    return  "
                                    <div class='alert alert-danger'>$error</div>
                                 ";
                } else {
                    $request = array(
                        'name'      => $request['name'],
                        'username'  => $request['username'],
                        'email'     => $request['email'],
                        'password'  => Hash::MakeHash($request['password'])
                    );
                    self::$queryString = parent::createQuery(self::$tableName,$request);
                    if (self::$queryString) {
                        self::$successMessage = "<div class='alert alert-success'>User account created</div>";
                        return self::$successMessage;
                    } else {
                        self::$errorMessage = "<div class='alert alert-danger'> Error in creating user account </div>";
                        return self::$errorMessage;
                    }
                }
            }
        }//End


        /***
         * @param $request
         * @return string
         * @throws Exception
         * @Login Auth User Method
         */
        public static function loginUser($request)
        {
            $redirectUrl = "../admin/dashboard.php";
            $validator = [
                'email'         => ['required', 'email'],
                'password'      => ['required', 'min' => 8, 'trim']
            ];
            self::$validatorCheck = Validator::coreValidator($request, $validator);
            if (Validator::error()) {
                Validator::errorLoop(Validator::error());
            } else {
                self::$requestResult = parent::readQuery(self::$tableName);
                if (self::$requestResult) {
                    foreach (self::$requestResult as $key => $value) {
                        $hash =  $value['password'];
                        if (Hash::VerifyHash($request['password'],$hash)) {
                            self::$makeSession = parent:: readOneQuery(self::$tableName,'email',$request['email']);
                            foreach(self::$makeSession as $request['email']) {
                                $_SESSION['session'] = $request['email'];
                                if (isset($_SESSION['session']))	{
                                    header("location:$redirectUrl");
                                }
                            }
                        } else {
                            self::$successMessage = "<div class='alert alert-danger'>Password is not correct...!</div>";
                            return self::$successMessage;
                        }
                    }
                } else {
                    self::$errorMessage = "<div class='alert alert-danger'>Details entered wrongly...!</div>";
                    return self::$errorMessage;
                }
            }
        }//End


        /***
         * @param $request
         * @return string
         * password reset method
         * this method helps to send a password reset link to the user to enable the user reset their password
         */

        public static function passwordReset($request)
        {
            $validator = [
                'email'         => ['required', 'email']
            ];
            self::$validatorCheck = Validator::coreValidator($request, $validator);
            if (Validator::error()) {
                Validator::errorLoop(Validator::error());
            } else {
                self::$queryString = parent:: readOneQuery(self::$tableName,'email',$request['email']);
                if (self::$queryString) {
                    $message = "
                            Hi follow the below link to reset your password <br>
                            <a href='http://localhost/_.CORE-PHP/ME-SITE/Auth/reset.php'>Reset Link</a>
                        ";
                    $subject = "Password Reset Link";
                    if (Mail::mailCreate($request['email'],$subject,$message));
                    self::$successMessage = "<div class='alert alert-success'>Please check your email for password reset link thanks</div>";
                    return self::$successMessage;
                } else {
                    self::$errorMessage = "<div class='alert alert-danger'>Sorry your details do not exist in our system...!</div>";
                    return self::$errorMessage;
                }
            }
        }//END



    }