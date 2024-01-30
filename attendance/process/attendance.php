<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('connection.php');

include_once('function.php');


if (isset($_POST['action']) && $_POST['action'] === 'attendance') {

    attendance($_POST);
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'edit') {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
    
if (!empty($checkIn) && !empty($checkOut)) { 
    // Convert checkIn and checkOut to timestamps
    $time1 = strtotime($checkIn);
    $time2 = strtotime($checkOut);
    

    // Calculate the gap between the two times
    $time_gap = abs($time2 - $time1);
    $time_gap_hours = floor($time_gap / 3600);
    $time_gap_minutes = floor(($time_gap % 3600) / 60);

    $totalhours = "$time_gap_hours:$time_gap_minutes";
   }else{
     $totalhours = "";
     }
    $sql = "UPDATE attendance SET name = '{$name}', date='{$date}', checkIn = '{$checkIn}', checkOut = '{$checkOut}', totalhours='{$totalhours}' WHERE id = {$id}";
    // print_r($sql);
   // exit;

  if (mysqli_query($GLOBALS['conn'], $sql)) {
      
      $url = $GLOBALS['SITE_URL'] . "attendance/index.php";
    echo "<script>window.location.href = '$url'</script>";
    exit; 
        // header("location:" . $GLOBALS['SITE_URL'] . "attendance/index.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
 }



if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'checkout') {

    $id = $_POST['id'];

    if (empty($id)) {
        $_SESSION['checkInError']['message'] = "Your check-in is pending. Please get in touch with the admin.";
        header("location:" . $GLOBALS['SITE_URL'] . "attendance");
        exit;
    }

    $sql = "SELECT * FROM attendance WHERE id = {$id}";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    if (!$result) {
        die("Database query error: " . mysqli_error($GLOBALS['conn']));
    }

    $row = $result->fetch_assoc();

    $id = $row['id'];
    $name = $row['name'];
    $date = $row['date'];
    $checkin = $row['checkIn'];

    if (!empty($row['totalhours'])) {
        
         $url = $GLOBALS['SITE_URL'] . "attendance/index.php";
    echo "<script>window.location.href = '$url'</script>";
    exit; // Stop further execution

        
        // header("location:" . $GLOBALS['SITE_URL'] . "attendance");
        // exit;
    }

    date_default_timezone_set('Asia/Karachi'); // Set the timezone to Pakistan
    $checkOut = date('H:i'); // Get the current time in HH:MM format

    // Convert 14:53 to 2:53 PM
    $time1 = strtotime($checkin);
    $time1_formatted = date("h:i A", $time1);

    // Convert 19:23 to 07:23 PM
    $time2 = strtotime($checkOut);
    $time2_formatted = date("h:i A", $time2);

    // Add the two times
    $sum_time = $time1 + $time2;
    $sum_time_formatted = date("h:i A", $sum_time);

    // Calculate the gap between the two times
    $time_gap = abs($time2 - $time1);
    $time_gap_hours = floor($time_gap / 3600);
    $time_gap_minutes = floor(($time_gap % 3600) / 60);

    $totalhours = "$time_gap_hours:$time_gap_minutes";

    $sql = "UPDATE attendance SET checkOut = '{$checkOut}', totalhours='{$totalhours}' WHERE id = {$id}";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    if (!$result) {
        die("Database query error: " . mysqli_error($GLOBALS['conn']));
    }

    // header("location:" . $GLOBALS['SITE_URL'] . "attendance");
    // exit;
    
      $url = $GLOBALS['SITE_URL'] . "attendance";
    echo "<script>window.location.href = '$url'</script>";
    exit; 
}




if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] == 'dataTable') {
    
    $searchValue = !empty($_GET['search']) ? $_GET['search'] : '';
    $dateRangeValue = !empty($_GET['dateRange']) ? $_GET['dateRange'] : '';
    
    if(!empty($dateRangeValue)){
        $dateFull = explode(" - ", $dateRangeValue);
       
        $start_date = date('Y-m-d', strtotime($dateFull[0]));
        $end_date = date('Y-m-d', strtotime($dateFull[1]));

        // $start_date = date('Y-m-d', strtotime($dateFull[0] . ' -1 day'));
        // $end_date = date('Y-m-d', strtotime($dateFull[1] . ' +1 day'));
    }

    $currentDate = date('Y-m-d'); // Get the current date in the format 'YYYY-MM-DD'
    
    $id = $_SESSION['loginData']['id'];
    if (isset($_GET['is_employee'])) {


        if (!empty($searchValue) && !empty($dateRangeValue)) {

            $sql = "SELECT * FROM attendance WHERE user_id=$id AND created_at BETWEEN '$start_date' AND '$end_date' AND (id LIKE '%$searchValue%' OR name LIKE '%$searchValue%' OR date LIKE '%$searchValue%' OR totalhours LIKE '%$searchValue%') ORDER BY id DESC";

        } elseif(!empty($dateRangeValue)){
            // Construct and execute the SQL query with date range filter
            $sql = "SELECT * FROM attendance WHERE user_id=$id AND created_at BETWEEN '$start_date' AND '$end_date' ORDER BY id DESC";

        }elseif(!empty($searchValue)){
            $sql = "SELECT * FROM attendance WHERE user_id=$id AND (id LIKE '%$searchValue%' OR name LIKE '%$searchValue%' OR date LIKE '%$searchValue%' OR totalhours LIKE '%$searchValue%') ORDER BY id DESC";
        }else {
            $sql = "SELECT * FROM attendance WHERE user_id=$id ORDER BY id DESC";
        }
    } else {
        $sql = "SELECT * FROM attendance WHERE DATE(created_at) = '$currentDate' ORDER BY id DESC";
        if (!empty($searchValue) && !empty($dateRangeValue)) {

            $sql = "SELECT * FROM attendance WHERE created_at BETWEEN '$start_date' AND '$end_date' AND (id LIKE '%$searchValue%' OR name LIKE '%$searchValue%' OR date LIKE '%$searchValue%' OR totalhours LIKE '%$searchValue%') ORDER BY id DESC";

        } elseif(!empty($dateRangeValue)){
            // Construct and execute the SQL query with date range filter

            // $sql = "SELECT * FROM attendance WHERE created_at BETWEEN '$start_date' AND '$end_date' ORDER BY id DESC"

            $sql = "SELECT * FROM attendance WHERE (date >= '$start_date' AND date <= '$end_date') OR date = '$start_date' ORDER BY id DESC";

        }elseif(!empty($searchValue)){
            $sql = "SELECT * FROM attendance WHERE (id LIKE '%$searchValue%' OR name LIKE '%$searchValue%' OR date LIKE '%$searchValue%' OR totalhours LIKE '%$searchValue%') ORDER BY id DESC";
        }
        
    }
    // echo $sql;
    // exit;
    $result = mysqli_query($GLOBALS['conn'], $sql);

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Add "Action" column to each row
foreach ($data as &$row) {

        $editLink = '<a class="btn btn-primary btn-l" href="edit.php?id=' . $row['id'] . '">Edit</a>';
        $deleteLink = '<a class="btn btn-danger btn-l" href="delete.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>';
        if ($_SESSION['loginData']['role'] == '1') {
        $nameLink = '<a class="btn btn-success btn-l" href="detail.php?id=' . $row['user_id'] . '"">'.$row['name'].'</a>';


        $row['name'] = $nameLink;}
        $row['action'] = $editLink . ' ' . $deleteLink;
    }

    echo json_encode(['data' => $data]);
    exit;
}










if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] == 'dataTable1') {



    $searchValue = !empty($_GET['search']) ? $_GET['search'] : '';
    $dateRangeValue = !empty($_GET['dateRange']) ? $_GET['dateRange'] : '';
    
    if(!empty($dateRangeValue)){
        $dateFull = explode(" - ", $dateRangeValue);
       
        $currentWeekStart = date('Y-m-d 00:00:00', strtotime($dateFull[0]));
        $currentWeekEnd = date('Y-m-d 23:59:59', strtotime($dateFull[1]));

    }else{
        $currentWeekStart = date('Y-m-d 00:00:00', strtotime('this week'));
        $currentWeekEnd = date('Y-m-d 23:59:59', strtotime('this week +6 days'));
    }


    $currentDate = date('Y-m-d');

    if (isset($_GET['id'])) {
        $userId = (int)$_GET['id']; // Sanitize and cast to an integer

        $sql = "SELECT * FROM attendance WHERE user_id = $userId AND created_at >= '$currentWeekStart' AND created_at <= '$currentWeekEnd'";
        
     

        $result = mysqli_query($conn, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $totalHours = 0; // Initialize total hours to 0

        foreach ($result as $row) {
            $user = getUsersById($row['user_id']);
            $totalHours += intval($row['totalhours']);
     
        }
     
    }

    
    echo json_encode(['data' => $result]);
    exit;
}
