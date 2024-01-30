<?php

include "../process/connection.php";

?>
<!doctype html>

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
                    <div class="container-fluid"> <br>
                        <h1 style="text-align: center;">Salary Form</h1> <br>
                        <form action="../process/salary.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="salary">

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">User_id</label>
                                <div class="col-sm-9">
                                    <select name="name" class="form-control" required>
                                        <option value="">--Select--</option>
                                        <?php
                                        $sql = "SELECT name,id FROM users WHERE role!=1";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Salary</label>
                                <div class="col-sm-9">
                                    <input type="text" name="salary_amount" class="form-control" value="" required>
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Increment Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" name="increment_amount" class="form-control" value="" required>
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label class="col-sm-3 col-form-label">Increment-Date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="increment_date" class="form-control" value="" required>
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
</body>

</html>


<?php
include("../layouts/footer.php");
?>

<button class="btn btn-sm btn-primary rounded-circle" onclick="scrollToTopFunction()" id="scrollToTop" title="Scroll to top">
    <i data-feather="arrow-up-circle"></i>
</button>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $("select[name='name']").on("change", function() {
        let id = $(this).val();
        if (id !== '') {
            $.ajax({
                type: "GET",
                url: BASE_URL + "process/salary.php?action=getSalaryByID&id=" + id,
                success: function(response) {
                    $('[name="salary_amount"]').val(response);
                }
            })
        } else {
            $('[name="salary_amount"]').val('');
        }
    })
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