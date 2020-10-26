<?php
    include_once('env.php');
    /**
     * this is the root email function
     * package built by 
     * Orutu Akposieyefa Williams 
     * Twitter => @Orutu_AW
     * Phone => 08100788859
     * Email => orutu1@gmail.com
     */
    class Mail
    {
        /**
         * Create email method
         */
        public static function createEmail($email,$subject,$message)
        {
            try {
                
                require_once("PHPMailer/PHPMailerAutoload.php");
                $mail=new PHPMailer();
                $mail->CharSet = 'UTF-8';
                $mail->IsSMTP();
                $mail->Host       = MAIL_HOST;
                $mail->SMTPSecure = MAIL_SMTP;
                $mail->Port       = MAIL_PORT;
                $mail->WordWrap = 50; 
                $mail->IsHTML(true); 
                $mail->SMTPAuth   = true;
                $mail->From     = APP_NAME;
                $mail->Username   = MAIL_USERNAME;
                $mail->Password   = MAIL_PASSWORD;
                $mail->SetFrom(MAIL_USERNAME);
                $mail->AddReplyTo(MAIL_USERNAME,'no-reply');
                $mail->Subject    = $subject;
                $mail->MsgHTML();
                    $mail->AddAddress($email , $message);
                    if (!$mail->send()) {
                        $msg= "Mailer Error: " . $mail->ErrorInfo;
                        return false;
                    }
                    return true;
            } catch (Exception $e) {
                self::$error = "Email Error : " . $e->getMessage();
				return self::$error;
            }
            
        }//End create email method

    }

