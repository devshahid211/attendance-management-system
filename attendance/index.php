<?php

include "../process/connection.php";

authMiddleWare();



$timezone = new DateTimeZone('Asia/Karachi');

$now = new DateTime('now', $timezone);

$current_time = $now->format('H:i');
$current_date = $now->format('Y-m-d');

$compare_time_checkin = "11:00";
$compare_time_checkout = "15:00";
$disable_time_checkout = "23:59";

$show_checkin = $current_time >= $compare_time_checkin && $current_time < $compare_time_checkout;
$show_checkout = $current_time >= $compare_time_checkout && $current_time < $disable_time_checkout;
$disable_checkout = $current_time >= $disable_time_checkout;

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

                <div class="content">
                    <div class="container-fluid">
                        <div class="container"> <br>

                            <h1 style="text-align: center;">Attendance Display</h1>

                            <?php
                            if ($_SESSION['loginData']['role'] == '2') {
                                $sql = "SELECT * FROM attendance WHERE user_id ={$_SESSION['loginData']['id']} and DATE(created_at) = CURDATE()";
                                $result = mysqli_query($GLOBALS['conn'], $sql);

                                $row = $result->fetch_assoc();

                                // echo "<pre>";
                                // print_r($row);
                                // exit;
                            }
                            ?>
                            
                            
                               	<?php if ($show_checkin && $_SESSION['loginData']['role'] == '2') { ?>
                                <form action="../process/attendance.php" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="action" value="attendance">

                                    <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $_SESSION['loginData']['name']; ?>" readonly>

                                    <input type="date" class="d-none form-control" id="date" name="date" value="<?php echo $current_date; ?>" readonly>

                                    <input type="time" class="d-none form-control" id="checkIn" name="checkIn" value="<?php echo $current_time; ?>" readonly>
                                    <div class="mb-3 checkIn">
                                        <div class="row justify-content-end mt-3">
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary">Check In</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                            


                              <?php if ($show_checkout && $_SESSION['loginData']['role'] == '2') { ?>
                                <div class="mb-3 checkOut">
                                    <div class="row justify-content-end mt-3">
                                        <div class="col-auto">
                                            <form method="POST" action="../process/attendance.php" enctype="multipart/form-data">
                                                <input type="hidden" name="action" value="checkout">
                                                <input type="hidden" name="id" value="<?php echo !empty($row['id']) ? $row['id'] : ""; ?>">
                                                <button class="btn btn-primary" type="submit">Check Out</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="row">
                                <div class="col-12">

                                    <?php
                                    if (!empty($_SESSION['checkInError']['message'])) { ?>
                                        <div class="alert alert-danger"><?php echo $_SESSION['checkInError']['message']; ?></div>
                                    <?php }
                                    unset($_SESSION['checkInError']);
                                    ?>

                                </div>
                            </div>

                            <?php
                            if ($_SESSION['loginData']['role'] == '1') {
                                include("adminAttendance.php");
                            } else {
                                include("employeeAttendance.php");
                            }
                            ?>
                        </div>
                    </tbody>
                </table>

                    </div>


                </div>

            </div>
        </div>
    </div>
    </div>
    <?php
    include("../layouts/footer.php");
    ?>

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
    <!-- Include Date Range Picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3/daterangepicker.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <?php

    $today = date("m/d/Y");
    // Calculate the date from 7 days ago
    $sevenDaysAgo = date("m/d/Y", strtotime("-7 days"));

    ?>
    <script>
        $(function() {

            let search = $('#employeeData_filter [type="search"]').val();
            let date_range = $('[name="date_range"]').val();

            $('#dateRangePicker').daterangepicker();

            var dataTable1;
            var dataTable2;
            if ($('#employeeData').length) {
                dataTable1 = new DataTable('#employeeData', {
                    ajax: {
                        url: BASE_URL + "process/attendance.php?action=dataTable&is_employee=true", // Modify this to your server-side script
                        type: 'GET',
                        "data": function(d) {
                            d.search = search;
                            d.dateRange = date_range;
                        }
                    },
                    processing: true,
                    serverSide: true,
                    searching: true, // Enable the search bar
                    'columns': [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
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
                        }
                    ]
                });
            }

            if ($('#adminData').length) {
                dataTable2 = new DataTable('#adminData', {
                    "ajax": {
                        "url": BASE_URL + "process/attendance.php?action=dataTable",
                        "data": function(d) {
                            d.search = search;
                            d.dateRange = date_range;
                        }
                    },
                    processing: true,
                    serverSide: true,
                    'columns': [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
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
                        {
                            data: 'action',
                            name: 'action'
                        },

                    ]
                });
            }

            $(document).on("keyup", '[type="search"]', function() {
                // console.log($(this),$(this).val());
                search = $(this).val();
                if (dataTable2) {
                    dataTable2.ajax.reload();
                }
                if (dataTable1) {
                    dataTable1.ajax.reload();
                }
            });

            $(document).on("change", '[name="date_range"]', function() {
                console.log($(this), $(this).val());
                date_range = $(this).val();
                if (dataTable2) {
                    dataTable2.ajax.reload();
                }
                if (dataTable1) {
                    dataTable1.ajax.reload();
                }
            });

        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            feather.replace();
        });
    </script>
    <script src="../assets/js/jspdf.min.js"></script>
    <script>
        function onClick() {
            var pdfExport = new jsPDF('p', 'pt', 'a4');
            var htmlTableContent = document.getElementById("tableContent");
            pdfExport.fromHTML(htmlTableContent);
            pdfExport.save('tableData.pdf');
        };

        var element = document.getElementById("exportToPDF1");
        element.addEventListener("click", onClick);
    </script>
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

    <script type="text/javascript">
        document.getElementById('finTable').addEventListener('click',
            function(item) {
                var row = item.path[1];
                var row_value = "";
                for (var j = 0; j < row.cells.length; j++) {
                    row_value += row.cells[j].innerHTML;
                    row_value += " | ";
                }

                //alert(row_value);
                var pdfExport = new jsPDF('p', 'pt', 'a4');
                pdfExport.fromHTML(row_value);
                pdfExport.save(row_value.split('|')[0].trim() + '.pdf');

                if (row.classList.contains('highlight'))
                    row.classList.remove('highlight');
                else
                    row.classList.add('highlight');
            });
    </script>
  </body>
</html>