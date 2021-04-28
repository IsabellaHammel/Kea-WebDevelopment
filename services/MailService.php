<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("{$_SERVER['DOCUMENT_ROOT']}/PHPMailer/src/PHPMailer.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/PHPMailer/src/SMTP.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/PHPMailer/src/Exception.php");


class MailService 
{
    public function __construct()
    {
    }

    public function sendMail(string $message, string $subject, string $recipient) 
    {
        try
        {
            $mail = $this->createMailer();
        
            //Recipients
            $mail->setFrom('webtestkea@gmail.com', 'Web Test KEA');
            $mail->addAddress($recipient, 'recipient');
        
            //Content
            $mail->isHTML(true);  
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function createMailer(): PHPMailer
    {
        $config = $this->get_config();

        $mail = new PHPMailer(true);
        
        //Server settings
        // $mail->SMTPDebug = 2;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Mailer     = "smtp";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Host       = $config['host'];                        //Set the SMTP server to send through
        $mail->Username   = $config['username'];                    //SMTP username
        $mail->Password   = $config['password'];                    //SMTP password
        $mail->Port       = $config['port'];                        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        $mail->SMTPOptions = array(                                 // To get mailer to work with localhost
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        return $mail;
    }

    private function get_config(): array
    {
        $config_file = 'serviceconfig.ini';
        $parsed_settings = parse_ini_file($config_file, TRUE);
        if (!$parsed_settings)
        {
            throw new exception('Unable to open ' . $config_file);
        }
        $mail_config = $parsed_settings['mail_service'];
        return $mail_config;
    }
}