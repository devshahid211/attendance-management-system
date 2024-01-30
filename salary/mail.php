<?php

include "../process/connection.php";

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$user_query = "SELECT * FROM users WHERE id = {$_GET['id']} ";
$user_result = mysqli_query($GLOBALS['conn'], $user_query);
$user_data = mysqli_fetch_assoc($user_result);

// print_r($user_data);
// exit;

$salarySql = "SELECT * FROM salary WHERE user_id = " . $_GET['id'] . " ORDER BY id DESC";

$salaryResult = mysqli_query($conn, $salarySql);
$salaryResult = mysqli_fetch_assoc($salaryResult);

$employeeName = $user_data['name'];
$email = $user_data['email'];
$salaryAmount = $salaryResult['salary_amount'];
$incrementAmount = $salaryResult['increment_amount'];
$currentDate = date("Y-m-d");
$currentmonth = date("Y-m");

// print_r($salaryResult);
// exit;

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output (0 for no debug output)
    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                   // Enable SMTP authentication
    $mail->Username   = 'shahidkhan3581873@gmail.com';       // SMTP username (your Gmail email address)
    $mail->Password   = 'mngqugmfdvsayapi';        // SMTP password (your Gmail password)
    $mail->SMTPSecure = 'tls';                  // Enable TLS encryption; `ssl` also accepted
    $mail->Port       = 587;                    // TCP port to connect to

    //Recipients
    $mail->setFrom('your@gmail.com', 'HR Manager Softheight ');  // Sender's email address and name
    $mail->addAddress($email, $employeeName);  // Recipient's email address and name
    $mail->addReplyTo('softheight@gmail.com', 'HR Manager Softheight');  // Reply-to email address and name

    // Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Salary Information Update';
    $mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Salary Update</title>
    </head>
    
    <body style="font-family: Arial, sans-serif;">
        <h1>Dear ' . $employeeName . ',</h1>
    
        <p>I hope you are well. We want to let you know about the salary update, which will take effect on [ ' . $currentmonth . '-01]. Because we value open communication, we want to make sure you are aware about your salary.</p>
    
        <h2>Salary Details:</h2>
        <ul>
            <li><b>Current Salary</b>: ' . $salaryAmount . ' </li>
            <li><b>New Salary</b>: ' . $incrementAmount . '</li>
            <li><b>Effective Date</b>: ' . $currentDate . '</li>
        </ul>
    
        <p>Like your hardwork and dedication have truly impressed us and we are delighted to have you as a member of our team and we look forward to achieving new milestones together.</p>
    
        <p>Please feel free to contact our HR department with any questions or concerns you may have about this move at hr@softheight.com or at +92 300 1183344.</p>
    
        <p>Best Regards,<br>
            HR Manager, Softheight</p>
    
    </body>
    
    </html>';

    // Send the email
    $mail->send();
    echo 'Message has been sent.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
