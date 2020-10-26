<?php
    include(ROOT_PATH. '/bootstrap/bootstrap.php');

    class Contact extends Model
    {
        private static $tableName = "tbl_contact";
        private static $validatorCheck;
        private static $result;
        public  static $error;
        public  static $success;
        private static $requestResult;

        /***
         * @param $request
         * @return string
         * @throws Exception
         * Contact message create Method
         */

        public static function contactCreate($request)
        {
            $validator = [
                'name' => ['required', 'min' => 6, 'max' => 150, 'trim'],
                'email' => ['required', 'email', 'html'],
                'service_id' => ['required'],
                'phone' => ['required', 'min' => 11, 'max' => 11],
                'message' => ['required']
            ];
            self::$validatorCheck = Validator::coreValidator($request, $validator);
            if (Validator::error()) {
                Validator::errorLoop(Validator::error());
            }else {
                $request = array(
                    'name'      => $request['name'],
                    'email'     => $request['email'],
                    'service_id'   => $request['service_id'],
                    'phone'   => $request['phone'],
                    'message' => $request['message'],
                );
                $inserted_row = parent::createQuery(self::$tableName,$request);
                if ($inserted_row) {
                    self::$success = "<div class='alert alert-success'> Message sent successfully </div>";
                    return self::$success;
                } else {
                    self::$error = "<div class='alert alert-danger'>Error in sending message </div>";
                    return self::error;
                }
            }

        }//End

        /***
         * @return false
         * @throws Exception
         * Get all contact message Method
         */
        public static function getAllContact()
        {
            self::$result = Pagination::Paginate(self::$tableName,5);
            if (self::$result) {
                return self::$result;
            }else {
                return false;
            }
        }//END

        /***
         * @param $id
         * @return array|false
         * Find single contact message method
         */
        public static function findContact($id)
        {
            self::$requestResult = parent::readOneQuery(self::$tableName, "id",$id);
            if (self::$requestResult) {
                return self::$requestResult;
            }else {
                return false;
            }
        }//END


        /***
         * @param $id
         * @return string
         * @throws Exception
         * Delete contact message Method
         */
        public static function delContactById($id)
        {
            self::$requestResult = parent::deleteQuery(self::$tableName,"id",$id);
            if (self::$requestResult) {
                return self::$requestResult;
            }else {
                return false;
            }
        }//END

    }