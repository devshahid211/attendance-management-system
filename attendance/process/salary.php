<?php

include_once('connection.php');

include_once('function.php');


if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] == 'getSalaryByID') {
    // echo $_GET['id'];
    // exit;
    $sql = "SELECT * from salary WHERE user_id={$_GET['id']} ORDER BY id DESC";

    $result = mysqli_query($GLOBALS['conn'], $sql);
    $result = mysqli_fetch_assoc($result);
    // print_r($result);
    echo $result['salary_amount'] + $result['increment_amount'];
    exit;
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'salary') {

    $user_id = $_POST['name'];
    // echo "<pre>";
    // print_r($_POST);
    // exit;
    $salary_amount = $_POST['salary_amount'];
    $increment_amount = $_POST['increment_amount'];
    $increment_date = $_POST['increment_date'];


    $sql = "INSERT INTO salary (user_id, salary_amount, increment_amount, increment_date)
            VALUES ('$user_id', '$salary_amount', '$increment_amount', '$increment_date')";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    header("location:" . $GLOBALS['SITE_URL'] . "salary/index.php");

    exit;
}




if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'edit') {
    
    $id = $_POST['id'];
    $user_id = $_POST['name'];
    $salary_amount = $_POST['salary_amount'];
    $increment_amount = $_POST['increment_amount'];
    $increment_date = $_POST['increment_date'];
    
    $sql = "UPDATE salary SET user_id = '{$user_id}', salary_amount = '{$salary_amount}', increment_amount = '{$increment_amount}', increment_date = '{$increment_date}' WHERE id = {$id}";

    if (mysqli_query($GLOBALS['conn'], $sql)) {

        header("location:" . $GLOBALS['SITE_URL'] . "salary/index.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
