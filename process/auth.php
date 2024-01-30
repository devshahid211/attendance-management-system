<?php

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

include_once('connection.php');

include_once('function.php');


if (isset($_POST['action']) && $_POST['action'] === 'registration') {

    registration($_POST);
    exit;
}



if (isset($_POST['action']) && $_POST['action'] == "login") {
    
$errors = array();

if (empty($_POST['email'])) {
    $errors['email'] = "Email is required";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
}

if (empty($_POST['password'])) {
    $errors['password'] = "Password is required";
}

if (!empty($errors)) {
    $_SESSION['login_errors'] = $errors;
    header("location:" . $GLOBALS['SITE_URL'] . "login.php");
    exit;
    
  } else {
      


    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM users WHERE email='{$_POST['email']}' AND password='{$password}'";

    $result = mysqli_query($conn, $sql);
    $result = $result->fetch_assoc();

    if (!empty($result)) {
        unset($_SESSION['error']['message']);

        $_SESSION['loginData'] = [
            'id' => $result["id"],
            'role' => $result["role"],
            'name' => $result["name"],
            'email' => $result["email"],
        ];
        
        // echo $GLOBALS['SITE_URL'] . "index.php";
        // exit;
        // echo "<pre>";
        // print_r($_SESSION);
        // exit;
        $url = $GLOBALS['SITE_URL'] . "index.php";
        
        echo "<script>window.location.href= '".$url."'</script>";

        // header("location:" . $GLOBALS['SITE_URL'] . "index.php");
        exit();
    } else {
        $_SESSION['error']['message'] = 'Credention did not match our Records';

        header("location:" . $GLOBALS['SITE_URL'] . "login.php");
        exit();
    }
}}



if (isset($_POST['action']) && $_POST['action'] == "logout") {

    unset($_SESSION['loginData']);
    
    $url = $GLOBALS['SITE_URL'] . "login.php";
    echo "<script>window.location.href= '".$url."'</script>";

    // header("location:" . $GLOBALS['SITE_URL'] . "login.php");
    
    exit;

}

