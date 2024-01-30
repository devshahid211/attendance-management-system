<?php

include "../process/connection.php";

roleBaseMiddleWare();

?>

<!Doctype html>

<html lang="en" class="h-100">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/leaf.svg">
    <title>Softheight</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <link href="../assets/css/main.css" rel="stylesheet">
    <link href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['SITE_URL'] . "assets/css/dataTables.bootstrap4.min.css" ?>">

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['SITE_URL'] . "assets/css/dataTables.bootstrap4.min.css" ?>">

    <style>
        table.dataTable {
            width: 100% !important;
        }
    </style>

</head>

<body class="d-flex flex-column h-100">
    <div id="page">
        <div class="wrapper">

            <?php
            include("../layouts/sidebar.php");
            ?>

            <div id="bodywrapper" class="container-fluid showhidetoggle">
                <?php
                include("../layouts/header.php");
                ?>

                <br>
                <div class="content">
                    <div class="container-fluid">
                        <div id="bodywrapper" class="container-fluid showhidetoggle">

                            <?php

                            $user_query = "SELECT * FROM attendance WHERE user_id = {$_GET['id']} ";
                            $user_result = mysqli_query($GLOBALS['conn'], $user_query);
                            $user_data = mysqli_fetch_assoc($user_result);

                            // print_r($user_data);
                            // exit;

                            $employeeName = $user_data['name'];

                            ?>

                            <h1 style="text-align: center;"><?php echo $user_data['name'] ?> Time Log</h1> <br>

                            <div class="row">
                                <div class="col-md-4 col-12 ms-auto">
                                    <form action="" method="post">
                                        <input type="hidden" name="action" value="filter">
                                        <div class="input-group mb-3">
                                            <input type="text" name="date_range" class="form-control" id="dateRangePicker">
                                        </div>
                                    </form>
                                </div>
                            </div> <br>

                            <table border="1" class="table" id="Total_hours">
                                <thead>
                                    <tr>

                                        <th>Date</th>
                                        <th>CheckIn</th>
                                        <th>CheckOut</th>
                                        <th>Total hours</th>

                                    </tr>
                                </thead>

                                <?php

                                $currentWeekStart = date('Y-m-d 00:00:00', strtotime('this week'));
                                $currentWeekEnd = date('Y-m-d 23:59:59', strtotime('this week +6 days'));

                                if (isset($_GET['id'])) {
                                    $userId = (int)$_GET['id']; // Sanitize and cast to an integer

                                    $sql = "SELECT * FROM attendance WHERE user_id = $userId AND created_at BETWEEN '$currentWeekStart' AND '$currentWeekEnd'";

                                    $result = mysqli_query($conn, $sql);
                                    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                    $time1 = "00:00"; // Initialize total hours to 0
                                    // $result_time = 0;

                                    foreach ($result as $row) {
                                        $user = getUsersById($row['user_id']);
                                        // $totalHours += intval($row['totalhours']);
                                        $time2 = !empty($row['totalhours']) ? $row['totalhours'] : "00:00";

                                        // Split the times into hours and minutes
                                        list($h1, $m1) = explode(":", $time1);
                                        // echo $time2;
                                        list($h2, $m2) = explode(":", $time2);

                                        // Convert both times to minutes
                                        $total_minutes1 = intval($h1) * 60 + intval($m1);
                                        $total_minutes2 = intval($h2) * 60 + intval($m2);

                                        // Add the minutes
                                        $total_minutes_sum = $total_minutes1 + $total_minutes2;

                                        // Convert the total back to hours and minutes
                                        $result_hours = floor($total_minutes_sum / 60);
                                        $result_minutes = $total_minutes_sum % 60;

                                        $time1 = sprintf("%02d:%02d", $result_hours, $result_minutes);
                                    }
                                }

                                ?>

                                <tfoot>

                                    <tr>
                                        <td colspan="3" style="background-color: yellow; color: black;">Total Hours</td>

                                        <td style="background-color: yellow; color: black;" class="total_time"><?php echo $time1; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>

    <?php include("../layouts/footer.php"); ?>

    <button class="btn btn-sm btn-primary rounded-circle" onclick="scrollToTopFunction()" id="scrollToTop" title="Scroll to top">
        <i data-feather="arrow-up-circle"></i>
    </button>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/Chart.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Include Date Range Picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3/daterangepicker.min.js"></script>

    <script>
        $(function() {

            // let search = $('#employeeData_filter [type="search"]').val();
            let date_range = '';
            // let date_range = $('[name="date_range"]').val();

            $('#dateRangePicker').daterangepicker();

            var dataTable2;

            if ($('#Total_hours').length) {
                dataTable2 = $('#Total_hours').DataTable({
                    "ajax": {
                        "url": BASE_URL + "process/attendance.php?action=dataTable1&id=" + '<?php echo $_GET['id']; ?>',
                        "data": function(d) {
                            // d.search = search;
                            d.dateRange = date_range;
                        }
                    },
                    processing: true,
                    serverSide: true,
                    'columns': [{
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'checkIn',
                            name: 'checkIn'
                        },
                        {
                            data: 'checkOut',
                            name: 'checkOut'
                        },
                        {
                            data: 'totalhours',
                            name: 'totalhours'
                        },

                    ]
                });
            }

            function calcTimeTotal() {
                // alert(66)
                let totalTime = "00:00";
                $("#Total_hours tr td:last-child").each(function() {
                    console.log($(this));

                    let time = $.trim($(this).text())
                    if (time) {
                        time.indexOf(":") < 1 ? time = time + ":00" : time
                        totalTime = addTimes(totalTime, time);
                    }

                })

                function addTimes(time1, time2) {
                    // Split the times into hours and minutes
                    const [h1, m1] = time1.split(":").map(Number);
                    const [h2, m2] = time2.split(":").map(Number);

                    // Convert both times to minutes
                    const totalMinutes1 = parseInt(h1) * 60 + parseInt(m1);
                    const totalMinutes2 = parseInt(h2) * 60 + parseInt(m2);
                    console.log(totalMinutes1, totalMinutes2, {
                        time1,
                        time2
                    });
                    // Add the minutes
                    const totalMinutesSum = totalMinutes1 + totalMinutes2;

                    // Convert the total back to hours and minutes
                    const resultHours = Math.floor(totalMinutesSum / 60);
                    const resultMinutes = totalMinutesSum % 60;

                    // Format the result as HH:MM
                    const resultTime = `${String(resultHours).padStart(2, '0')}:${String(resultMinutes).padStart(2, '0')}`;

                    return resultTime;
                }

                // Display the total time in the footer cell
                $('.total_time').text(totalTime);
            }


            $(document).on("change", '#dateRangePicker', function() {
                date_range = $(this).val();
                if (dataTable2) {
                    dataTable2.one('draw.dt', function() {
                        // This function will run after dataTable2 has finished redrawing
                        calcTimeTotal();
                    }).ajax.reload();
                }
            });


            $(document).on("keyup", '[type="search"]', function() {
                // console.log($(this),$(this).val());
                search = $(this).val();
                if (dataTable2) {

                    dataTable2.ajax.reload();
                }
                setInterval(() => {
                    calcTimeTotal()
                }, 800);

            });
        });
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            feather.replace();
        });
    </script>

    <script src="assets/js/jspdf.min.js"></script>

    <script>
        function showTableData() {
            var oTable = document.getElementById('finTable');
            var rowLength = oTable.rows.length;
            for (i = 0; i < rowLength; i++) {
                var oCells = oTable.rows.item(i).cells;
                var cellLength = oCells.length;
                for (var j = 0; j < cellLength; j++) {
                    var cellVal = oCells.item(j).innerHTML;
                    //alert(cellVal);
                }
            }
        }
    </script>

</body>

</html>