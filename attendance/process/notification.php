<?php

include_once('connection.php');

include_once('function.php');

include_once('../Mailer.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'notification') {
     
    $user_id = json_encode($_POST['name']);
    
    $ids = json_decode($user_id, true);
    
    $idList = implode(',', $ids);
    
    $emails = [];

    $users_query = "SELECT * FROM users WHERE id IN ($idList)";

    $users_result = mysqli_query($conn, $users_query);

    $usersData = mysqli_fetch_all($users_result, MYSQLI_ASSOC);

    foreach ($usersData as $row) {
      array_push($emails, $row["email"]);
    }

    // echo "<pre>";
    // print_r($emails);
    // exit;
    
    $mailer = new Mailer();
    foreach ($emails as $key => $email) {
    $mailer->sendMail($email,$_POST["subject"],$_POST["message_content"]);
    }
    exit;

    $message_content = $_POST["message_content"];
    $subject = $_POST["subject"];

    $sql = "INSERT INTO notifications (user_id ,message_content ,subject) VALUES ('$user_id','$message_content' ,'$subject')";

    $result = mysqli_query($GLOBALS['conn'], $sql);
    
     $url = $GLOBALS['SITE_URL'] . "mail.php";
    echo "<script>window.location.href = '$url'</script>";
    exit; 

    // header("location:" . $GLOBALS['SITE_URL'] . "mail.php");
    // exit;
  
}

  ?>
