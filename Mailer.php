<?php
// include "process/connection.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    // private $mail;
    // private $subject;
    // private $message;

    // public function __construct() {    
    // }

    public function sendMail($email, $subject, $contentMessage) {
        
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'shahidkhan3581873@gmail.com';
            $mail->Password   = 'mngqugmfdvsayapi';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('your@gmail.com', 'HR Manager Softheight');

            // Set the recipient's email address and name
            $mail->addAddress($email, 'Recipient Name');

            // Content (modify as needed)
            $mail->isHTML(true);
            $mail->Subject = $subject;

            //   echo "<pre>";
            //     print_r($mail);
            //     exit;

            $mail->Body = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Information Update</title>
                </head>
                <body style="font-family: Arial, sans-serif;">
                    ' . $contentMessage . '
                </body>
                </html>';

            // Send the email
            $mail->send();

            // Clear recipients to prepare for the next email
            $mail->clearAddresses();
                

            echo 'Message have been sent .';

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>
