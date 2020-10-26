<?php
/**
     * this is the root hash file 
     * this class is used for password hashing
     * package built by 
     * Orutu Akposieyefa Williams 
     * Twitter => @Orutu_AW
     * Phone => 08100788859
     * Email => orutu1@gmail.com
     */
	class Hash
	{
		private static  $md5;
		private static  $sha1;
		private static  $crypt;
		private static  $password_peppered;
		private static  $hash;
		private static  $salt;
		private static  $pepper;
		private static  $error;

        /***
         * @param $length
         * RANDOM STRING GENERATOR
         */
        public static function randString( $length )
        {
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@#$&*";
            $size = strlen( $chars );
            for( $i = 0; $i < $length; $i++ ) {
                 $str    = $chars[ rand( 0, $size - 1 ) ];
            }

        }//END RANDOM STRING


        /***
         * @param $password
         * @return false|string|null
         * Make Hash Method
         */
		public static function MakeHash($password) 
		{
			try {

				self::$pepper = self::randString(10);
				self::$salt = self::randString(2);
				self::$md5 = md5($password);
				self::$sha1 = sha1(self::$md5);
				self::$crypt = crypt(self::$sha1,self::$salt);
				self::$password_peppered = hash_hmac('sha256', self::$crypt, self::$pepper);
				return self::$hash = password_hash(self::$password_peppered, PASSWORD_BCRYPT);

			} catch (Exception $e) {
				
				self::$error = "Password Hash Error: " . $e->getMessage();
				return self::$error;
				
			}
		    
		}//END OF MAKE HASH

        /***
         * @param $password
         * @param $hash
         * @return bool|string
         * Verify Hash Method
         */
		public static function verifyHash($password,$hash)
		{ 
			try {

                self::$pepper = self::randString(10);
                self::$salt = self::randString(2);
				self::$md5 = md5($password);
				self::$sha1 = sha1(self::$md5);
				self::$crypt = crypt(self::$sha1,self::$salt);

				self::$password_peppered = hash_hmac('sha256', self::$crypt, self::$pepper);

				if (password_verify(self::$password_peppered, $hash)) {
					return true;
				} else {
					return false;
				}

			} catch (Exception $e) {
				
				self::$error = "Password Verify Error: " . $e->getMessage();
				return self::$error;
				
			}
	        
		}//END OF PASSWORD VERIFY

	}



