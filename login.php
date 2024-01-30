<?php

include "process/connection.php";

echo"hello";
exit;
if (isset($_SESSION['loginData']) && isset($_SESSION['loginData']['id'])) {
	header("location:" . $GLOBALS['SITE_URL'] . "index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/leaf.svg">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	.error {
		color: red;
	}

	* {
		font-family: 'quicksand', Arial, Helvetica, sans-serif;
		box-sizing: border-box;
	}

	body {
		background: #fff;
		background-image: url('assets/img/bg.svg');
		background-repeat: no-repeat;
		background-size: cover;
	}

	.form-modal {
		position: relative;
		width: 450px;
		height: auto;
		margin-top: 4em;
		left: 50%;
		transform: translateX(-50%);
		background: #fff;
		border-top-right-radius: 20px;
		border-top-left-radius: 20px;
		border-bottom-right-radius: 20px;
		box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1)
	}

	.form-modal button {
		cursor: pointer;
		position: relative;
		text-transform: capitalize;
		font-size: 1em;
		z-index: 2;
		outline: none;
		background: #fff;
		transition: 0.2s;
	}

	.form-modal .btn {
		border-radius: 20px;
		border: none;
		font-weight: bold;
		font-size: 1.2em;
		padding: 0.8em 1em 0.8em 1em !important;
		transition: 0.5s;
		border: 1px solid #ebebeb;
		margin-bottom: 0.5em;
		margin-top: 0.5em;
	}

	.form-modal .login {
		background: #0d6efd;
		color: #fff;
	}



	.form-modal .login:hover {
		background: #003399;
	}


	.form-toggle {
		position: relative;
		width: 100%;
		height: auto;
	}

	.form-toggle button {
		width: 100%;
		float: left;
		padding: 1.5em;
		margin-bottom: 1.5em;
		border: none;
		transition: 0.2s;
		font-size: 1.1em;
		font-weight: bold;
		border-top-right-radius: 20px;
		border-top-left-radius: 20px;
		border-bottom-right-radius: 0;
	}

	#login-toggle {
		background: #0d6efd;
		color: #ffff;
	}

	.form-modal form {
		position: relative;
		width: 90%;
		height: auto;
		left: 50%;
		transform: translateX(-50%);
	}

	#login-form {
		position: relative;
		width: 100%;
		height: auto;
		padding-bottom: 0.5em;
	}



	#login-form button {
		width: 100%;
		margin-top: 0.5em;
		padding: 0.6em;
	}

	.form-modal input {
		position: relative;
		width: 100%;
		font-size: 1em;
		padding: 0.6em 0.8em 0.6em 0.8em;
		margin-top: 0.3em;
		margin-bottom: 0.3em;
		border-radius: 20px;
		border: none;
		background: #ebebeb;
		outline: none;
		font-weight: bold;
		transition: 0.7s;
	}

	.form-modal input:focus,
	.form-modal input:active {
		transform: scaleX(1.02);
	}

	.form-modal input::-webkit-input-placeholder {
		color: #222;
	}

	.form-modal p {
		font-size: 16px;
		font-weight: bold;
	}

	.form-modal p a {
		color: #57b846;
		text-decoration: none;
		transition: 0.2s;
	}

	.form-modal p a:hover {
		color: #222;
	}

	.form-modal i {
		position: absolute;
		left: 10%;
		top: 50%;
		transform: translateX(-10%) translateY(-50%);
	}

	.-box-sd-effect:hover {
		box-shadow: 0 4px 8px hsla(210, 2%, 84%, .2);
	}


	main>.container {
		padding: 60px 15px 0 0;
	}

	.error {
		color: red;
	}

	.alert {
		color: red;
	}
</style>
</head>

<body>
	<div id="page">
		<div class="form-modal">
			<div class="form-toggle">
				<button id="login-toggle" onclick="toggleLogin()">Log In</button>
			</div>
			<div id="login-form">
				<div class="container">
					<form action="process/auth.php" id="login" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="action" value="login" />

						<div class="alert">
							<?php
							if (!empty($_SESSION['error']) && !empty($_SESSION['error']['message'])) {
								echo $_SESSION['error']['message'];
							}
							unset($_SESSION['error']['message']);
							?>
						</div>

						<div class="mb-3">
							<label for="email" class="form-label">Email:</label>
							<input type="text" class="form-control" id="email" name="email" required>
						</div>


						<div class="error">
							<?php
							if (!empty($_SESSION['login_errors']['email'])) {
								echo $_SESSION['login_errors']['email'];
							}
							?>
						</div>
						<br>

						<div class="mb-3">
							<label for="password" class="form-label">Password:</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>


						<div class="error">
							<?php
							if (!empty($_SESSION['login_errors']['password'])) {
								echo $_SESSION['login_errors']['password'];
							}
							?>
						</div>
						<br>

						<button type="submit" class="btn login">
							<i data-feather="log-in" class="data-feather mr-1"></i> Login
						</button>

						<hr />
						<div class="text-muted" style="text-align: center;">
							Footer content <a target="_blank" href="register.php">Register.</a>
						</div>
					</form>
				</div>
			</div>
		</div>

</body>

</html>

<?php
unset($_SESSION['login_errors']);
?>