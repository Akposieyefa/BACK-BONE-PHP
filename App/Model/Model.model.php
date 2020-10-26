<?php
    include(ROOT_PATH . '/bootstrap/bootstrap.php');
    /***
     * This is the root Model file
     * package built by
     * @Orutu Akposieyefa Williams
     * Twitter => @Orutu_AW
     * Phone => 08100788859
     * Email => orutu1@gmail.com
     */
    class Model extends DB
    {
        private static $action;
        private static $rowCount;
        private static $stmt;
        private static $queryString;
        private static $fetchQuery;

        /***
         * @param $tableName
         * @param $request
         * @return false|int
         * @throws Exception
         * @CREATE QUERY METHOD
         */
        public function createQuery($tableName, $request) {
            if(is_array($request)):
                try {
                    $array_ks = array_keys($request);
                    $array_ks_1 = implode(", ", $array_ks);
                    $i=0;
                    foreach ($request as $key => $value) {
                        $stmt_Val[$i] = $value;
                        $stmt_Param[$i] = ":".$key;
                        $i++;
                    }
                    $stmtParam_1 = implode(", ", $stmt_Param);
                    self::$queryString = "INSERT INTO $tableName ($array_ks_1) VALUES ($stmtParam_1)";
                    self::$stmt = parent::dbConnect()->prepare(self::$queryString);
                    foreach ($stmt_Param as $key => $value) {
                        self::$stmt->bindParam($value,$stmt_Val[$key]);
                    }
                    self::$action = self::$stmt->execute() or
                    die(parent::$error . __LINE__);
                    self::$rowCount = self::$stmt->rowCount();
                    if (self::$rowCount > 0) {
                        return self::$rowCount;
                    } else {
                        return false;
                    }
                } catch (Exception $e) {
                    throw new Exception("Create Query Error: ".$e->getMessage());
                }
            endif;
        }//END



        /***
         * @param $tableName
         * @return false
         * @throws Exception
         * @READ QUERY METHOD
         */
        public static function readQuery($tableName, $limit = NULL)
        {
            try {
                if ($limit == NULL) {
                    self::$queryString = "SELECT * FROM $tableName ORDER BY id DESC";
                } else {
                    self::$queryString = "SELECT * FROM $tableName ORDER BY id DESC lIMIT $limit ";
                }
                self::$stmt = parent::dbConnect()->prepare(self::$queryString);
                self::$action = self::$stmt->execute() or
                die(parent::$error . __LINE__);
                self::$rowCount = self::$stmt->rowCount();
                if (self::$rowCount > 0) {
                    self::$fetchQuery = self::$stmt->fetchAll();
                    return self::$fetchQuery;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                throw new Exception("Read Query Error: ".$e->getMessage());
            }
        }//END

        /***
         * @param $tableName
         * @param $dbField
         * @param $request
         * @return array|false
         * @READ ONE QUERY METHOD
         */
        public static function readOneQuery($tableName, $dbField, $request)
        {
            try {

                self::$queryString ="SELECT * FROM $tableName WHERE $dbField = ?";
                self::$stmt = parent::dbConnect()->prepare(self::$queryString);
                self::$stmt->bindValue(1, $request);
                self::$action = self::$stmt->execute() or
                die(parent::$error . __LINE__);
                self::$rowCount = self::$stmt->rowCount();
                if (self::$rowCount > 0) {
                    self::$fetchQuery = self::$stmt->fetchAll();
                    return self::$fetchQuery;
                } else {
                    return false;
                }
            }catch (Exception $e) {
                throw new Exception("Read One Query  Error: ".$e->getMessage());
            }

        }//END

        /***
         * @param $tableName
         * @param $request
         * @param $condition
         * @param $true
         * @return false|int
         * @throws Exception
         * @UPDATE QUERY METHOD
         */
        public static function updateQuery($tableName,$request,$condition,$true_value){

            try {

                $i = 0;
                foreach ($request as $key => $value) {
                    $set_value[$i] = $key."='".$value."'";
                    $i++;
                }
                $set_value = implode(", ", $set_value);
                self::$queryString = "UPDATE $tableName SET $set_value WHERE $condition = $true_value";
                self::$stmt = parent::dbConnect()->prepare(self::$queryString);
                self::$action = self::$stmt->execute() or
                die(parent::$error . __LINE__);
                self::$rowCount = self::$stmt->rowCount();
                if (self::$rowCount > 0) {
                    return self::$rowCount;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                throw new Exception("Update Query Error: ".$e->getMessage());
            }
        }//END

        /***
         * @param $tableName
         * @param $request
         * @return false
         * @throws Exception
         * @DELETE QUERY METHOD
         */
        public  static function deleteQuery($tableName,$dbField,$request)
        {
            try {

                self::$queryString = "DELETE FROM $tableName WHERE $dbField = ?";
                self::$stmt = parent::dbConnect()->prepare(self::$queryString);
                self::$stmt->bindValue(1, $request);
                self::$action = self::$stmt->execute() or
                die(parent::$error . __LINE__);
                self::$rowCount = self::$stmt->rowCount();
                if (self::$rowCount > 0) {
                    return self::$rowCount;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                throw new Exception("Delete Query Error: ".$e->getMessage());
            }
        }//END


    }
