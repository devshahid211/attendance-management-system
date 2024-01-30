<?php

include "../process/connection.php";

authMiddleWare();

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
                    <div class="container-fluid">
                        <div id="bodywrapper" class="container-fluid showhidetoggle"><br>
                            <h1 style="text-align: center;">Details</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>User</th>
                                        <th>Salary</th>
                                        <th>Increment-Amount</th>
                                        <th>Increment_date </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT * FROM salary WHERE user_id = {$_GET['user_id']}";

                                    $result = mysqli_query($conn, $sql);
                                    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                    foreach ($result as $row) {
                                        $user = getUserById($row['user_id']);
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $user['name'] ?></td>
                                            <td><?php echo $row['salary_amount']; ?></td>
                                            <td><?php echo $row['increment_amount']; ?></td>
                                            <td><?php echo $row['increment_date']; ?></td>
                                        </tr>
                                    <?php } ?>
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
    <script type="text/javascript">
        var trafficchart = document.getElementById("trafficflow");
        var saleschart = document.getElementById("sales");

        var myChart1 = new Chart(trafficchart, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul',
                    'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
                datasets: [{
                    backgroundColor: "rgba(48, 164, 255, 0.5)",
                    borderColor: "rgba(48, 164, 255, 0.8)",
                    data: ['1135', '1135', '1140', '1168', '1150', '1145',
                        '1155', '1155', '1150', '1160', '1185', '1190'
                    ],
                    label: '',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: 'Chart'
                },
                legend: {
                    position: 'top',
                    display: false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Months'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Number of Visitors'
                        }
                    }]
                }
            }
        });

        var myChart2 = new Chart(saleschart, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul',
                    'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
                datasets: [{
                    label: 'Income',
                    backgroundColor: "rgba(76, 175, 80, 0.5)",
                    borderColor: "#6da252",
                    borderWidth: 1,
                    data: ["280", "300", "400", "600", "450", "400", "500",
                        "550", "450", "650", "950", "1000"
                    ],
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: 'Chart'
                },
                legend: {
                    position: 'top',
                    display: false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Months'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Number of Users'
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>