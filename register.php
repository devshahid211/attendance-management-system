<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/leaf.svg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .error {
            color: red;
        }

        body {
            background: #fff;
            background-image: url('assets/img/bg.svg');
            background-repeat: no-repeat;
            background-size: cover;
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
            box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
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

        */ .form-modal .btn {
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

        #loading {
            display: block;
            position: fixed;
            top: 40%;
            left: 45%;
            width: 150px;
            height: 150px;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
</head>

<body>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-modal p-4">
                    <div class="form-toggle mb-4">
                        <button class="btn btn-primary bg-primary text-white">Sign Up</button>
                    </div>
                    <div id="signup-form">

                        <div class="container">
                            <form action="process/auth.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="registration">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="error">
                                    <?php

                                    if (!empty($_SESSION['registration_errors']['name'])) {
                                        echo $_SESSION['registration_errors']['name'];
                                    }
                                    ?>
                                </div>
                           

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="error">
                                    <?php
                                    if (!empty($_SESSION['registration_errors']['email'])) {
                                        echo $_SESSION['registration_errors']['email'];
                                    }
                                    ?>
                                </div>

                                <?php
                                if (!empty($_SESSION["error"]["email"])) { ?>
                                    <div class="error">
                                        <?php echo $_SESSION["error"]["email"]; ?>
                                    </div>
                                <?php }
                                ?>

                               
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="error">
                                    <?php
                                    if (!empty($_SESSION['registration_errors']['password'])) {
                                        echo $_SESSION['registration_errors']['password'];
                                    }
                                    ?>
                                </div>
                            

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>

                                <div class="error">
                                    <?php
                                    if (!empty($_SESSION['registration_errors']['phone'])) {
                                        echo $_SESSION['registration_errors']['phone'];
                                    }
                                    ?>
                                </div>
                            
                            
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation:</label>
                                    <input type="text" class="form-control" id="designation" name="designation" required>
                                </div>

                                <div class="error">
                                    <?php
                                    if (!empty($_SESSION['registration_errors']['designation'])) {
                                        echo $_SESSION['registration_errors']['designation'];
                                    }
                                    ?>
                                </div>
                          
                          
                                <div class="mb-3">
                                    <label class="form-label">Type:</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">---Select---</option>
                                        <option value="internee">Internee</option>
                                        <option value="probation">Probation</option>
                                        <option value="permanent">Permanent</option>
                                    </select>
                                </div>

                                <div class="error">
                                    <?php
                                    if (!empty($_SESSION['registration_errors']['type'])) {
                                        echo $_SESSION['registration_errors']['type'];
                                    }
                                    ?>
                                </div>
                             

                                <div id="button" class="mb-3">
                                    <input type="submit" value="Register" style="width: 100%;" class="btn btn-primary">
                                </div>
                            </form>
                        </div>

                        <div class="text-muted text-center">
                            Footer content <a target="_blank" href="login.php">Login.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
unset($_SESSION['registration_errors']);

unset($_SESSION['error']);
?>