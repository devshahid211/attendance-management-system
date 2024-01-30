<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once('connection.php');

include_once('function.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'edit') {

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$designation = $_POST['designation'];
$type = $_POST['type'];
$joining_date = $_POST['joining_date'];

$sql = "UPDATE users SET name = '{$name}', email='{$email}', phone = '{$phone}', designation ='{$designation}', type = '{$type}', joining_date='{$joining_date}' WHERE id = {$id}";

// print_r($sql);
// exit;

if (mysqli_query($GLOBALS['conn'], $sql)) {
    // header("location: " . $GLOBALS['SITE_URL'] . "employee/index.php");
    $url = $GLOBALS['SITE_URL'] . "employee/index.php";
    echo "<script>window.location.href = '$url'</script>";
    exit; // Stop further execution


// if (mysqli_query($GLOBALS['conn'], $sql)) {

//     header("location:" . $GLOBALS['SITE_URL'] . "employee/index.php");

} else {
    
    echo "Error updating record: " . mysqli_error($conn);
}}
