<?php
    namespace Core\Library;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require ROOT . DS . "core" . DS . "library" . DS . "PHPMailer" . DS . "src" . DS . "PHPMailer.php";
    require ROOT . DS . "core" . DS . "library" . DS . "PHPMailer" . DS . "src" . DS . "Exception.php";
    require ROOT . DS . "core" . DS . "library" . DS . "PHPMailer" . DS . "src" . DS . "SMTP.php";
    class Mailer{
        private $mail;
        function __construct(){
            $this->mail = new PHPMailer(MAILER_EXCEPTION);
            $this->mail->SMTPDebug = SMTP_DEBUG;
            $this->mail->isSMTP();
            $this->mail->Host = SMTP_SERVER;
            $this->mail->SMTPAuth = true;
            $this->mail->Username = SMTP_USER;
            $this->mail->Password = SMTP_PASSWORD;
            $this->mail->SMTPSecure = SMTP_SECURE;
            $this->mail->Port = SMTP_PORT;
            $this->mail->setFrom(MAIL['from'],MAIL['admin']);
        }
        public function send_plain_mail($recipients,$subject,$body){
            try{
                if(is_array($recipients)){
                    foreach ($recipients as $recipient){
                        $this->mail->addAddress($recipient);
                    }
                }else{
                    $this->mail->addAddress($recipients);
                }
                $this->mail->isHTML(false);
                $this->mail->Subject = $subject;
                $this->mail->Body = $body;
                $this->mail->send();
                return true;
            }catch (Exception $ex){
                return false;
            }
        }
        public function send_html_mail($recipients,$subject,$body){
            try{
                if(is_array($recipients)){
                    foreach ($recipients as $recipient){
                        $this->mail->addAddress($recipient);
                    }
                }else{
                    $this->mail->addAddress($recipients);
                }
                $this->mail->isHTML(true);
                $this->mail->Subject = $subject;
                $this->mail->Body = $body;
                $this->mail->send();
                return true;
            }catch (Exception $ex){
                return false;
            }
        }
        public function send_plain_mail_with_attachment($recipients,$subject,$body,$attachments){
            try{
                if(is_array($recipients)){
                    foreach ($recipients as $recipient){
                        $this->mail->addAddress($recipient);
                    }
                }else{
                    $this->mail->addAddress($recipients);
                }
                $this->mail->isHTML(false);
                $this->mail->Subject = $subject;
                $this->mail->Body = $body;
                if(is_array($attachments)){
                    foreach ($attachments as $attachment){
                        $this->mail->addAttachment($attachment);
                    }
                }else{
                    $this->mail->addAttachment($attachments);
                }
                $this->mail->send();
                return true;
            }catch (Exception $ex){
                return false;
            }
        }
        public function send_html_mail_with_attachment($recipients,$subject,$body,$attachments){
            try{
                if(is_array($recipients)){
                    foreach ($recipients as $recipient){
                        $this->mail->addAddress($recipient);
                    }
                }else{
                    $this->mail->addAddress($recipients);
                }
                $this->mail->isHTML(true);
                $this->mail->Subject = $subject;
                $this->mail->Body = $body;
                if(is_array($attachments)){
                    foreach ($attachments as $attachment){
                        $this->mail->addAttachment($attachment);
                    }
                }else{
                    $this->mail->addAttachment($attachments);
                }
                $this->mail->send();
                return true;
            }catch (Exception $ex){
                return false;
            }
        }
    }
?>