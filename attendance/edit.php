<?php

include "../process/connection.php";
include_once "../process/function.php";

authMiddleWare();

$id = $_GET['id'];

$row = getAttendieByID($id);

$name = $row['name'];
$date = $row['date'];
$checkIn = $row['checkIn'];
$checkOut = $row['checkOut'];
$totalhours = $row['totalhours'];

?>

<!Doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/leaf.svg">
    <title>Avni - Bootstrap 5 Admin Template</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
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
                        <br>
                        <h1 style="text-align: center;">Edit User</h1><br>

                        <form method="POST" action="../process/attendance.php">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="date" class="form-control" value="<?php echo $date; ?>">
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">CheckIn</label>
                                <div class="col-sm-9">
                                    <input type="time" name="checkIn" id="checkIn" class="form-control" value="<?php echo $checkIn; ?>" onchange="calculateTotalHours()">
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">CheckOut</label>
                                <div class="col-sm-9">
                                    <input type="time" name="checkOut" class="form-control" id="checkOut" value="<?php echo $checkOut; ?>" onchange="calculateTotalHours()">
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Total Hours</label>
                                <div class="col-sm-9">
                                    <input type="text" name="totalhours" class="form-control" id="totalhours" value="<?php echo $totalhours; ?>">
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-12 number-end text-end">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                    <a class="btn btn-outline-primary btn-lg" href="index.php">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function calculateTotalHours() {
                        var checkInTime = document.getElementById("checkIn").value;
                        var checkOutTime = document.getElementById("checkOut").value;

                        if (checkInTime && checkOutTime) {
                            var startTime = new Date("1970-01-01 " + checkInTime);
                            var endTime = new Date("1970-01-01 " + checkOutTime);

                            var timeDiff = endTime - startTime;
                            var hours = Math.floor(timeDiff / 3600000); // 3600000 milliseconds in an hour
                            var minutes = Math.round((timeDiff % 3600000) / 60000); // 60000 milliseconds in a minute

                            document.getElementById("totalhours").value = hours + ":" + (minutes < 10 ? "0" : "") + minutes;
                        }
                    }
                </script>
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
    <script src="../assets/js/script.js"></script>

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