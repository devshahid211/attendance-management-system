<?php

  session_start();

 $GLOBALS['SITE_URL'] = "http://localhost/attendance.softheight.com/";

// $GLOBALS['SITE_URL'] = "http://attendance.softheight.com/";

$GLOBALS['conn'] = mysqli_connect('localhost', 'root', '', 'attendance_sheet');

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());
}


function authMiddleWare(){

    if(!isset($_SESSION['loginData']) && !isset($_SESSION['loginData']['id'])){
        header("location:".$GLOBALS['SITE_URL']."login.php");
        exit;
    }
}



function roleBaseMiddleWare(){

    if(isset($_SESSION['loginData']) && isset($_SESSION['loginData']['id'])){
        if($_SESSION['loginData']['role'] != 1){
            if(isset($_SERVER['HTTP_REFERER'])) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
                
            } else {
                header("location:".$GLOBALS['SITE_URL']);
                exit;
            }
        }
    }
}



function getUserById($id) {
    if (!isset($id) || !is_numeric($id)) {
        return null; 
    }

    $sql = "SELECT * FROM users WHERE id = {$id}";
    $result = mysqli_query($GLOBALS['conn'], $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null; 
    }
}



function getUsersById($id) {
    if (!isset($id) || !is_numeric($id)) {
        return null; 
    }

    $sql = "SELECT * FROM attendance WHERE user_id = {$id}";
    $result = mysqli_query($GLOBALS['conn'], $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null; 
    }
}

