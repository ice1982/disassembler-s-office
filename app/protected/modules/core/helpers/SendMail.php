<?php
class SendMail
{
    /**
    * Отправка почты
    * @param str $to
    * @param str $subject
    * @param str $message
    */
    public static function send($to, $subject, $message)
    {
        $__smtp = Yii::app()->params['smtp'];

        Yii::app()->mailer->IsSMTP();
        Yii::app()->mailer->Subject = $subject;
        Yii::app()->mailer->Body    = $message;

        Yii::app()->mailer->ClearAddresses();

        if (is_array($to)) {
            foreach ($to as $value) {
                Yii::app()->mailer->AddAddress($value);
            }
        } else {
            Yii::app()->mailer->AddAddress($to);
        }

        Yii::app()->mailer->IsHTML(true);
        Yii::app()->mailer->Host      = $__smtp['host'];
        Yii::app()->mailer->SMTPDebug = $__smtp['debug'];
        Yii::app()->mailer->SMTPAuth  = $__smtp['auth'];
        Yii::app()->mailer->Host      = $__smtp['host'];
        Yii::app()->mailer->Port      = $__smtp['port'];
        Yii::app()->mailer->Username  = $__smtp['username'];
        Yii::app()->mailer->Password  = $__smtp['password'];
        Yii::app()->mailer->CharSet   = $__smtp['charset'];
        Yii::app()->mailer->From      = $__smtp['from'];
        Yii::app()->mailer->FromName  = $__smtp['fromname'];

        return Yii::app()->mailer->Send();
    }

    // public static function sendEmail($from, $to, $subject, $message)
    // {
    //     #Адрес сервера
    //     $SmtpServer = "smtp.gmail.com";
    //     #Адрес порта
    //     $SmtpPort="25";
    //     #Логин авторизации на сервера SMTP
    //     $SmtpUser = "citrus.plus.smtp@gmail.com";
    //     #Пароль авторизации на сервера SMTP
    //     $SmtpPass = "53JzNYvKyV5M";

    //     $SmtpServer = $SmtpServer;
    //     $SmtpUser = base64_encode($SmtpUser);
    //     $SmtpPass = base64_encode($SmtpPass);
    //     $from = $from;
    //     $to = $to;
    //     if (is_array($to)) {
    //         $to = implode(';', $to);
    //     }

    //     $subject = $subject;
    //     $body = $message;

    //     if ($SmtpPort == "") {
    //         $PortSMTP = 25;
    //     } else {
    //         $PortSMTP = $SmtpPort;
    //     }

    //     $HTTP_HOST = $_SERVER['HTTP_HOST'];
    //     $HTTP_HOST = 'bristol-msk.ru';

    //     if ($SMTPIN = fsockopen ($SmtpServer, $PortSMTP)) {
    //         fputs ($SMTPIN, "EHLO ".$HTTP_HOST."\r\n");
    //         $talk["hello"] = fgets ( $SMTPIN, 1024 );
    //         fputs($SMTPIN, "auth login\r\n");
    //         $talk["res"]=fgets($SMTPIN,1024);
    //         fputs($SMTPIN, $SmtpUser."\r\n");
    //         $talk["user"]=fgets($SMTPIN,1024);
    //         fputs($SMTPIN, $SmtpPass."\r\n");
    //         $talk["pass"]=fgets($SMTPIN,256);
    //         fputs ($SMTPIN, "MAIL FROM: <".$from.">\r\n");
    //         $talk["From"] = fgets ( $SMTPIN, 1024 );
    //         fputs ($SMTPIN, "RCPT TO: <".$to.">\r\n");
    //         $talk["To"] = fgets ($SMTPIN, 1024);
    //         fputs($SMTPIN, "DATA\r\n");
    //         $talk["data"]=fgets( $SMTPIN,1024 );
    //         fputs($SMTPIN, "To: <".$to.">\r\nFrom: <".$from.">\r\nSubject:".$subject."\r\n\r\n\r\n".$body."\r\n.\r\n");
    //         $talk["send"]=fgets($SMTPIN,256);
    //         fputs ($SMTPIN, "QUIT\r\n");
    //         fclose($SMTPIN);
    //     }

    //     return $talk;
    // }

    // public static function sendEmail($from, $to, $subject, $message)
    // {
    //     // if (is_array($to)) {
    //     //     $to = implode(',', $to);
    //     // }



    //     $mail=Yii::app()->Smtpmail;

    //     // var_dump($mail);

    //     $mail->SetFrom($from, 'From NAme');
    //     $mail->Subject    = $subject;
    //     $mail->MsgHTML($message);


    //     if (is_array($to)) {
    //         foreach ($to as $address) {
    //             $mail->AddAddress($address, "");
    //         }
    //     }

    //     $result = $mail->Send();

    //     var_dump($mail->ErrorInfo);

    //     return $result;

    //     // if(!$mail->Send()) {
    //     //     echo "Mailer Error: " . $mail->ErrorInfo;
    //     // }else {
    //     //     echo "Message sent!";
    //     // }
    // }

    /**
     *
     */
    public static function sendEmail($from, $to, $subject, $message)
    {
        if (is_array($to)) {
            $to = implode(',', $to);
        }

        return mail($to, $subject, $message, "Content-Type: text/html; charset=utf-8;\nFrom: $from");
    }
}