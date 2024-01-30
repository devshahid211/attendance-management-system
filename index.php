<?php

include "process/connection.php";


authMiddleWare();

?>
<!Doctype html>
<html lang="en" class="h-100">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/leaf.svg">
	<title>SoftHeight</title>
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
	<div id="page">
		<div class="wrapper">

			<?php
			include("layouts/sidebar.php");
			?>

			<div id="bodywrapper" class="container-fluid showhidetoggle">
				<?php
				include("layouts/header.php");
				?>

				<div class="content">
					<div class="container-fluid">
						<div id="bodywrapper" class="container-fluid showhidetoggle">

						<div class="content">
								<div class="container-fluid">
									<div class="row mt-2">
										<div class="col-md-12 float-start">
									
								
								
								<?php

									$id = $_SESSION['loginData']['id'];

									$user_query = "SELECT * FROM attendance WHERE user_id = $id";
									$user_result = mysqli_query($GLOBALS['conn'], $user_query);
									$user_data = mysqli_fetch_assoc($user_result);


									$employeeName = $user_data['name'];

									?>

									<h4 style="text-align: center;">Well Come <?php echo $user_data['name'] ?></h4>
										</div><br>
										<div class="col-md-6">
											<ol class="breadcrumb float-end">
											</ol>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="card card-rounded">
												<div class="content">
													<div class="row">
														<div class="col-sm-4">
															<div class="icon-big text-center">
																<!-- <i class="teal data-feather-big" stroke-width="3" data-feather="shopping-cart"></i> -->
																<img src="assets/img/clock.svg" alt="Avni - The Earth" class="img-fluid rounded-circle mb-2" width="50px" height="135" />

															</div>
														</div>
														<div class="col-sm-8">
															<div class="detail">
																<p class="detail-subtitle">WeeklyHours</p>
																<span class="number">
																	<?php
																	$id = $_SESSION['loginData']['id'];
																	// Get the first day of the current week
																	$start_date = date('Y-m-d', strtotime('this week'));

																	// Get the last Friday
																	$end_date = date('Y-m-d', strtotime('next Friday'));

																	$sql = "SELECT * FROM attendance WHERE user_id=$id AND created_at BETWEEN '$start_date' AND '$end_date'";

																	$result = mysqli_query($GLOBALS['conn'], $sql);
																	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


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
																		// print_r($time1);
																	}


																	// echo "<pre>";
																	// print_r($time1);
																	// print_r($data);
																	// print_r($end_date);
																	// exit;
																	?>


																	<td><?php echo $time1; ?></td>


																</span>
															</div>
														</div>
													</div>
													<div class="footer">
														<hr />
														<div class="d-flex justify-content-between box-font-small">
															<div class="col-md-6 stats">
																<i data-feather="calendar"></i> This Week
															</div>
															<div class="col-md-6">
																<a class="text-primary float-end" href="#"><i class="blue" data-feather="chevrons-right"></i>See Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="card card-rounded">
												<div class="content">
													<div class="row">
														<div class="col-sm-4">
															<div class="icon-big text-center">
																<!-- <i class="olive data-feather-big" stroke-width="3" data-feather="dollar-sign"></i> -->
																<img src="assets/img/clock.svg" alt="Avni - The Earth" class="img-fluid rounded-circle mb-2" width="50px" height="135" />
															</div>
														</div>
														<div class="col-sm-8">
															<div class="detail">
																<p class="detail-subtitle">MonthlyHour</p>
																<span class="number">

																	<?php
																	$id = $_SESSION['loginData']['id'];

																	// Get the first day of the current month
																	$start_date = date('Y-m-01');

																	// Get the last day of the current month
																	$end_date = date('Y-m-t');

																	$sql = "SELECT * FROM attendance WHERE user_id=$id AND created_at BETWEEN '$start_date' AND '$end_date'";

																	$result = mysqli_query($GLOBALS['conn'], $sql);
																	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

																	
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
																		// print_r($time1);
																	}


																	// echo "<pre>";
																	// print_r($time1);
																	// print_r($data);
																	// print_r($end_date);
																	// exit;
																	?>


																	<td><?php echo $time1; ?></td>


																</span>
															</div>
														</div>
													</div>
													<div class="footer">
														<hr />
														<div class="d-flex justify-content-between box-font-small">
															<div class="col-md-6 stats">
																<i data-feather="calendar"></i> This Week
															</div>
															<div class="col-md-6">
																<a class="text-primary float-end" href="#"><i class="blue" data-feather="chevrons-right"></i>See Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>



										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="card card-rounded">
												<div class="content">
													<div class="row">
														<div class="col-sm-4">
															<div class="icon-big text-center">
																<img src="assets/img/event-hat-icon.svg" alt="Avni - The Earth" class="img-fluid rounded-circle mb-2" width="50px" height="135" />
															</div>
														</div>
														<div class="col-sm-8">
															<div class="detail">
																<p class="detail-subtitle">DateOfBirth</p>
																<span class="number" class="text-size">
																	<?php

																	$user_id = $_SESSION['loginData']['id'];
																	$sql = "SELECT dateofbirth FROM users WHERE id = {$user_id}";

																	$result = $conn->query($sql);

																	if ($result->num_rows > 0) {
																		$row = $result->fetch_assoc();
																		$dateofbirth = $row['dateofbirth'];
																		echo  $dateofbirth;
																	} else {
																		echo "User not found or date of birth not available.";
																	}
																	?></span>
															</div>
														</div>
													</div>
													<div class="footer">
														<hr />
														<div class="d-flex justify-content-between box-font-small">
															<div class="col-md-6 stats">
																<i data-feather="calendar"></i> This Week
															</div>
															<div class="col-md-6">
																<a class="text-primary float-end" href="#"><i class="blue" data-feather="chevrons-right"></i>See Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

 
										
										
										<!--<div class="col-sm-6 col-md-6 col-lg-3">-->
										<!--	<div class="card card-rounded text-center">-->
										<!--		<div class="content">-->
										<!--			<img src="assets/img/earth.svg" alt="Avni - The Earth" class="img-fluid rounded-circle mb-2" width="135" height="135" />-->
										<!--		</div>-->
										<!--	</div>-->
										<!--</div>-->

										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="card card-rounded">
												<div class="content">
													<div class="row">
														<div class="col-sm-4">
															<div class="icon-big text-center">
																<i class="orange data-feather-big" stroke-width="3" data-feather="mail"></i>
															</div>
														</div>
														<div class="col-sm-8">
															<div class="detail">
																<p class="detail-subtitle">Notifications</p>
																<span class="number">1275</span>
															</div>
														</div>
													</div>
													<div class="footer">
														<hr />
														<div class="d-flex justify-content-between box-font-small">
															<div class="col-md-6 stats">
																<i data-feather="mail"></i> This month
															</div>
															<div class="col-md-6">
																<a class="text-primary float-end" href="#"><i class="blue" data-feather="chevrons-right"></i>See Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-6">
													<div class="card">
														<div class="content">
															<div class="head">
																<h5 class="mb-0">Web Traffic</h5>
																<p class="text-muted">Visitor data</p>
															</div>
															<div class="canvas-wrapper">
																<canvas class="chart" id="trafficflow"></canvas>
															</div>
															<div class="ui hidden divider"></div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card">
														<div class="content">
															<div class="head">
																<h5 class="mb-0">Number of Users</h5>
																<p class="text-muted">Users per month</p>
															</div>
															<div class="canvas-wrapper">
																<canvas class="chart" id="sales"></canvas>
															</div>
															<div class="ui hidden divider"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="card">
												<div class="content">
													<div class="head">
														<h5 class="mb-0">Top Visitors by Country</h5>
														<p class="text-muted">Fiscal user data</p>
													</div>
													<div class="canvas-wrapper">
														<table class="table no-margin">
															<thead class="success">
																<tr>
																	<th>Country</th>
																	<th class="text-right">Unique Visitors</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><i class="text-primary" data-feather="flag"></i>
																		United States</td>
																	<td class="text-right">27,340</td>
																</tr>
																<tr>
																	<td><i class="text-danger" data-feather="flag"></i>
																		Pakistan</td>
																	<td class="text-right">21,280</td>
																</tr>
																<tr>
																	<td><i class="text-primary" data-feather="flag"></i>
																		Japan</td>
																	<td class="text-right">18,210</td>
																</tr>
																<tr>
																	<td><i class="text-success" data-feather="flag"></i>
																		United Kingdom</td>
																	<td class="text-right">15,176</td>
																</tr>
																<tr>
																	<td><i class="text-warning" data-feather="flag"></i>
																		Pakistan</td>
																	<td class="text-right">14,276</td>
																</tr>
																<tr>
																	<td><i class="text-warning" data-feather="flag"></i>
																		Germany</td>
																	<td class="text-right">13,176</td>
																</tr>
																<tr>
																	<td><i class="text-success" data-feather="flag"></i>
																		Pakistan</td>
																	<td class="text-right">12,176</td>
																</tr>
																<tr>
																	<td><i class="text-primary" data-feather="flag"></i>
																		United States</td>
																	<td class="text-right">11,886</td>
																</tr>
																<tr>
																	<td><i class="text-success" data-feather="flag"></i>
																		Pakistan</td>
																	<td class="text-right">11,509</td>
																</tr>
																<tr>
																	<td><i class="text-info" data-feather="flag"></i>
																		Pakistan</td>
																	<td class="text-right">1,700</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="card">
												<div class="content">
													<div class="head">
														<h5 class="mb-0">Most Visited Pages</h5>
														<p class="text-muted">Fiscal visitor data</p>
													</div>
													<div class="canvas-wrapper">
														<table class="table no-margin table-striped">
															<thead class="success">
																<tr>
																	<th>Page Name</th>
																	<th class="text-right">Visitors</th>
																	<th>Target</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">8,340</td>
																	<td>
																		<div class="progress" style="height: 20px;">
																			<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">7,280</td>
																	<td>
																		<div class="progress" style="height: 10px;">
																			<div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">6,210</td>
																	<td>
																		<div class="progress" style="height: 20px;">
																			<div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">5,176</td>
																	<td>
																		<div class="progress" style="height: 10px;">
																			<div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">4,276</td>
																	<td>
																		<div class="progress" style="height: 10px;">
																			<div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">3,176</td>
																	<td>
																		<div class="progress" style="height: 10px;">
																			<div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">2,176</td>
																	<td>
																		<div class="progress" style="height: 10px;">
																			<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																</tr>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">1,886</td>
																	<td>
																		<div class="progress" style="height: 10px;">
																			<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">1,509</td>
																	<td>
																		<div class="progress" style="height: 10px;">
																			<div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td><a href="index.html" class="text-info"><i data-feather="link" class="data-feather blue"></i>index.html
																		</a></td>
																	<td class="text-right">1,100</td>
																	<td>
																		<div class="progress" style="height: 10px;">
																			<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="card">
										<div class="content" id="tableContent">
											<div class="head">
												<h5 class="mb-0">Financial review</h5>
												
											</div>
											<div class="canvas-wrapper">
												<table class="table no-margin" id="finTable">
													<thead class="success">
														<tr>
															<th>Name</th>
															<th>Sale-Rate</th>
															<th>Actual</th>
															<th>Variance</th>
															
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Jacob Jensen</td>
															<td>85%</td>
															<td>32,435</td>
															<td>40,234</td>
															
														</tr>
														<tr>
															<td>Cecelia Bradley</td>
															<td>55%</td>
															<td>4,36780</td>
															<td>765728</td>
															
														</tr>
														<tr>
															<td>Leah Sherman</td>
															<td>23%</td>
															<td>2300</td>
															<td>22437</td>
														
														</tr>
														<tr>
															<td>Ina Curry</td>
															<td>44%</td>
															<td>53462</td>
															<td>1,75938</td>
															
														</tr>
														<tr>
															<td>Lida Fitzgerald</td>
															<td>65%</td>
															<td>67453</td>
															<td>765377</td>
															
														</tr>
														<tr>
															<td>Stella Johnson</td>
															<td>49%</td>
															<td>43662</td>
															<td>96535</td>
															
														</tr>
														<tr>
															<td>Maria Ortiz</td>
															<td>65%</td>
															<td>76555</td>
															<td>258546</td>
															
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="card card-rounded">
												<div class="content">
													<div class="row">
														<div class="dfd text-center">
															<i class="blue data-feather-big" stroke-width="3" data-feather="thumbs-up"></i>
															<h4 class="mb-0">+21,900</h4>
															<p class="text-muted">Social Likes</p>
														</div>
													</div>
													<div class="footer">
														<hr />
														<div class="d-flex justify-content-between box-font-small">
															<div class="col-md-6 stats">
																<i data-feather="calendar"></i> This Week
															</div>
															<div class="col-md-6">
																<a class="text-primary float-end" href="#"><i class="blue" data-feather="chevrons-right"></i>See Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="card card-rounded">
												<div class="content">
													<div class="row">
														<div class="dfd text-center">
															<i class="grey data-feather-big" stroke-width="3" data-feather="share-2"></i>
															<h4 class="mb-0">+22,566</h4>
															<p class="text-muted">Followers</p>
														</div>
													</div>
													<div class="footer">
														<hr />
														<div class="d-flex justify-content-between box-font-small">
															<div class="col-md-6 stats">
																<i data-feather="calendar"></i> This Week
															</div>
															<div class="col-md-6">
																<a class="text-primary float-end" href="#"><i class="blue" data-feather="chevrons-right"></i>See Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="card card-rounded">
												<div class="content">
													<div class="row">
														<div class="dfd text-center">
															<i class="orange data-feather-big" stroke-width="3" data-feather="mail"></i>
															<h4 class="mb-0">+15,566</h4>
															<p class="text-muted">Subscribers</p>
														</div>
													</div>
													<div class="footer">
														<hr />
														<div class="d-flex justify-content-between box-font-small">
															<div class="col-md-6 stats">
																<i data-feather="calendar"></i> This Week
															</div>
															<div class="col-md-6">
																<a class="text-primary float-end" href="#"><i class="blue" data-feather="chevrons-right"></i>See Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="card card-rounded">
												<div class="content">
													<div class="row">
														<div class="dfd text-center">
															<i class="olive data-feather-big" stroke-width="3" data-feather="dollar-sign"></i>
															<h4 class="mb-0">+98,601</h4>
															<p class="text-muted">Sales</p>
														</div>
													</div>
													<div class="footer">
														<hr />
														<div class="d-flex justify-content-between box-font-small">
															<div class="col-md-6 stats">
																<i data-feather="calendar"></i> This Week
															</div>
															<div class="col-md-6">
																<a class="text-primary float-end" href="#"><i class="blue" data-feather="chevrons-right"></i>See Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>

						</div>


					</div>

				</div>
			</div>
		</div>
	</div>
	<?php
	include("layouts/footer.php");
	?>

	<button class="btn btn-sm btn-primary rounded-circle" onclick="scrollToTopFunction()" id="scrollToTop" title="Scroll to top">
		<i data-feather="arrow-up-circle"></i>
	</button>
	<script src="assets/js/feather.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/Chart.min.js"></script>
	<script src="assets/js/script.js"></script>

	<script type="text/javascript">
		document.addEventListener("DOMContentLoaded", function(event) {
			feather.replace();
		});
	</script>
	<script src="assets/js/jspdf.min.js"></script>
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