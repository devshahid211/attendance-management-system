<?php

include_once('connection.php');

function registration($formData)

{
    
  $name = $formData['name'];
  $email = $formData['email'];
  $password = $formData['password'];
  $password = md5($password);
  $phone = $formData['phone'];
  $designation = $formData['designation'];

  $type = $formData['type'];

  $errors = array();
  if (empty($formData['name'])) {
    $errors['name'] = "Name is required";
  }
  if (empty($_POST['email'])) {
    $errors['email'] = "Email is required";
  } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
  }
  if (empty($formData['password'])) {
    $errors['password'] = "Password is required";
  }
  if (empty($formData['phone'])) {
    $errors['phone'] = "Phone Number is required";
  }
  if (empty($formData['designation'])) {
    $errors['designation'] = "Designation is required";
  }
  if (empty($formData['type'])) {
    $errors['type'] = "Type is required";
  }

  if (!empty($errors)) {
    $_SESSION['registration_errors'] = $errors;
    header("location:" . $GLOBALS['SITE_URL'] . "register.php");
    exit;
  }


  if (empty($errors)) {
    // Check if the email is already in use
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
      $_SESSION["error"] = [
        'email' => "Provided email is already taken."
      ];
      $_SESSION['formData'] = $formData  ;
      
       $url = $GLOBALS['SITE_URL'] . "register.php";
    echo "<script>window.location.href = '$url'</script>";
    exit; 
      
    //   header("location:" . $GLOBALS['SITE_URL'] . "register.php");
    //   exit;

    } else {
      // Insert the user data into the database
      $sql = "INSERT INTO users (name, email, password, phone, designation, type) 
                VALUES ('$name', '$email', '$password', '$phone', '$designation','$type')";

      $result = mysqli_query($GLOBALS['conn'], $sql);
      
         $url = $GLOBALS['SITE_URL'] . "login.php";
    echo "<script>window.location.href = '$url'</script>";
    exit; 

    //   header("location:" . $GLOBALS['SITE_URL'] . "login.php");
    //   exit;
    
    }
  }
}


function attendance($formData)
{

  $id = $_SESSION['loginData']['id'];
  $todayData = date("Y-m-d");

  $getToday = "select * from attendance where user_id={$id} AND DATE(created_at) = '$todayData'";
  $res = mysqli_query($GLOBALS['conn'], $getToday);
  $res = mysqli_fetch_assoc($res);
  if (!empty($res)) {
      
        $url = $GLOBALS['SITE_URL'] . "attendance/index.php";
    echo "<script>window.location.href = '$url'</script>";
    exit; 
      
    // header("location:" . $GLOBALS['SITE_URL'] . "attendance");
    // exit;
  }


  $name = $formData['name'];
  $date = $formData['date'];
  $checkIn = $formData['checkIn'];

//   echo "<pre>";
//   print_r($formData);
//   exit;


  $checkOut = isset($formData['checkOut']) ? $formData['checkOut'] : null;
  $totalhours = isset($formData['totalhours']) ? $formData['totalhours'] : null;

  $sql = "INSERT INTO attendance (name, user_id, `date`, checkIn, checkOut, totalhours) 
  VALUES ('$name', '{$id}', '$date', '$checkIn', '$checkOut', '$totalhours')";

  // echo $sql;
  // exit;

  $result = mysqli_query($GLOBALS['conn'], $sql);

  $url = $GLOBALS['SITE_URL'] . "attendance/index.php";
    echo "<script>window.location.href = '$url'</script>";
    exit; // Stop further execution

//   header("location:" . $GLOBALS['SITE_URL'] . "attendance/index.php");
//   exit;

}


function getAttendieByID($id)
{

  $sql = "SELECT * FROM attendance WHERE  id = {$id}";
  $result = mysqli_query($GLOBALS['conn'], $sql);
  return mysqli_fetch_assoc($result);
}


function getAttendiyByID($id){

  $sql = "SELECT * FROM salary WHERE  id = {$id}";
  $result = mysqli_query($GLOBALS['conn'], $sql);
  return mysqli_fetch_assoc($result);
}


function getAttendieByIDs($id)
{

  $sql = "SELECT * FROM users WHERE  id = {$id}";
  $result = mysqli_query($GLOBALS['conn'], $sql);
  return mysqli_fetch_assoc($result);
}

?>



