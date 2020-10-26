<?php
    include_once('env.php');
    /**
     * this is the root database file 
     * that connects to the project database
     * package built by 
     * Orutu Akposieyefa Williams 
     * Twitter => @Orutu_AW
     * Phone => 08100788859
     * Email => orutu1@gmail.com
     */
    class DB
    {
        public static $link;
        public static $error;

        public static $config =  array(

            'host'      => DB_HOST,
            'user'      => DB_USER,
            'password'  => DB_PASS,
            'dbname'    => DB_NAME
            
        );

        /***
         * @return PDO|string
         * DB connect Method
         */
        public static function dbConnect() 
        {
            try {

                self::$link = new PDO(
                    'mysql:host=' .self::$config['host'].'; dbname=' . self::$config['dbname'], self::$config['user'], self::$config['password']
                );
                self::$link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$link->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                self::$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$link;

            } catch (PDOException $e) {

                self::$error = "Database connection failed: " . $e->getMessage();
                return self::$error;
            }

        }//End of database connection method

    }
