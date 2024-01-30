<?php

include "../process/connection.php";

authMiddleWare();

roleBaseMiddleWare();

?>
<!doctype html>

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
                    <div class="container-fluid"> <br>
                         <h1 style="text-align: center;">Salary</h1>
                        <a href="insert.php" class="btn btn-primary">Add Salary</a> <br> <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>User</th>
                                    <th>Salary</th>
                                    <th>Increment-Amount</th>
                                    <th>Increment_date </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                           $sql = "SELECT * FROM salary";

                           $result = mysqli_query($GLOBALS['conn'], $sql);
                           
                            $dataSalaries = mysqli_fetch_all($result,MYSQLI_ASSOC);
                            $finalArry = [];

                            foreach ($dataSalaries as $key => $dataSalary) {
                                $finalArry[$dataSalary['user_id']] = $dataSalary;
                            }

                                foreach ($finalArry as $row) {
                                    $user = getUserById($row['user_id']);
                                ?>
                                    <tr>

                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $user['name'] ?></td>
                                        <td><?php echo $row['salary_amount']; ?></td>
                                        <td><?php echo $row['increment_amount']; ?></td>
                                        <td><?php echo $row['increment_date']; ?></td>

                                        <td>
                                            <a class="btn btn-primary btn-l" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                            <a class='btn btn-danger btn-l' href='delete.php?id=<?php echo $row['id']; ?>' onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                            <a class="btn btn-primary btn-l" href="view.php?user_id=<?php echo $row['user_id'] ?>">View</a>
                                            <a class="btn btn-dark btn-l" href="mail.php?id=<?php echo $row['user_id'] ?>">Mail</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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