<?php

include "../process/connection.php";

include_once "../process/function.php";

roleBaseMiddleWare();
authMiddleWare();

$id = $_GET['id'];

$userRow = getAttendieByIDs($id);

$name = $userRow['name'];
$email = $userRow['email'];
$phone = $userRow['phone'];
$designation = $userRow['designation'];
$type = $userRow['type'];
$joining_date = $userRow['joining_date'];

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

                        <form method="POST" action="../process/employee.php">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="number" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>">
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Designation</label>
                                <div class="col-sm-9">
                                    <input type="text" name="designation" id="designation" class="form-control" value="<?php echo $designation; ?>" >
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <input type="text" name="type" class="form-control" id="type" value="<?php echo $type; ?>" >
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Joining_date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="joining_date" class="form-control" id="joining_date" value="<?php echo !empty($userRow['joining_date']) ? $userRow['joining_date'] : date("Y-m-d", strtotime($userRow['created_at'])); ?>">
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