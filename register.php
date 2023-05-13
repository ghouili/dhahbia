<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$sex = $username =  $tele = $email = $password = $confirm_password = $matiere = "";
$sex_err = $username_err = $tele_err = $email_err = $password_err = $confirm_password_err = $matiere_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "hello";
    // Validate sex
    $sex = $_POST["sex"];
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate tele
    if (empty(trim($_POST["tele"]))) {
        $tele_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["tele"])) > 8) {
        $tele_err = "Password must have atleast 6 characters.";
    } else {
        $tele = trim($_POST["tele"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter a email.";
    } elseif (strlen(trim($_POST["email"])) < 6) {
        $email_err = "email must have atleast 6 characters.";
    } else {
        $email = trim($_POST["email"]);
    }


    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
    // Validate matiere
    $matiere = $_POST["matiere"];


    // Check input errors before inserting in database
    if (empty($sex_err) && empty($username_err) && empty($tele_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($matiere_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users ( sex, username, tele, email, password, matiere) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_sex, $param_username, $param_tele, $param_email, $param_password, $param_matiere);

            // Set parameters
            $param_sex = $sex;
            $param_username = $username;
            $param_tele = $tele;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_matiere = $matiere;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sayaridhahbia@gmail.com'; //fac gmail
                $mail->Password = 'ulxkevzunhvroxzz'; //fac gmail app password
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('sayaridhahbia@gmail.com'); //fac gmail

                $mail->addAddress($_POST["email"]);

                $mail->isHTML(true);

                $mail->Subject = 'bienveu';
                $mail->Body = '<div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f5f5f5;">
        <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 10px; padding: 20px;">
            <h1 style="text-align: center; color: #3d3d3d; margin-bottom: 40px;">Welcome to Our App!</h1>
            <p style="font-size: 18px; color: #3d3d3d;">Salut ' . $username . ' ,</p>
            <p style="font-size: 18px; color: #3d3d3d;">Votre nouveau compte a été créé avec succès dans notre application TIRGE EN LIGNE.</p>
            <p style="font-size: 18px; color: #3d3d3d;">Veuillez conserver votre mot de passe en lieu sûr. Vous pouvez changer votre mot de passe à tout moment en vous connectant à votre compte.</p>
            <p style="font-size: 18px; color: #3d3d3d;">Voici votre mot de passe: <strong>' . $password . '</strong></p>
            <div style="text-align: center; margin-top: 40px;">
                <a href="https://www.google.com/" style="display: inline-block; background-color: #0066ff; color: white; font-size: 18px; padding: 12px 30px; text-decoration: none; border-radius: 30px;">Découvrez notre application</a>
            </div>
            <p style="font-size: 16px; color: #666; margin-top: 40px;">Merci a utiliser notre application!</p>
        </div>
    </div>'; // html body;

                $mail->send();
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Startup - Startup Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <div class="nav-item dropdown">

                        <a href="#" class="nav-link dropdown-toggle" style="font-size: 16px ;margin-right: 5px ; color:#fff;" data-toggle="dropdown"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                            </svg></i></label> téléphone</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="blog.html" class="dropdown-item">+216 75 272 281</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" style="font-size: 16px ;margin-right: 5px ; color:#fff;" data-toggle="dropdown"><label class="icon" for="email"><i class="fas fa-envelope"></i></label> E-mail</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="" class="dropdown-item">isggb@isggb.run.tn</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="https://isggb.rnu.tn/" class="logo">
                <img src="https://isggb.rnu.tn/frontoffice/assets/images/logoIsggb.png" alt="IMG-LOGO" style="padding: 10px;">
            </a>
            <a href="index.php" class="navbar-brand p-0">
                <h1 class="m-0">ISG GABES</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                </div>
            </div>
        </nav>
        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Inscription</h1>

                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Full Screen Search Start -->

    <!-- Full Screen Search End -->


    <!-- Contact Start -->
    <div align="center">
        <div class="row g-5">
            <div class="col-lg-12 wow slideInUp" data-wow-delay="0.3s">


                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row g-3">
                        <div align="center">

                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="text" name="username" class="form-control border-0 bg-light px-4" placeholder="Nom et Prénom" style="height: 55px;" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="tel" name="tele" class="form-control border-0 bg-light px-4" placeholder="Téléphone" style="height: 55px;" <?php echo (!empty($tele_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tele; ?>">
                                <span class="invalid-feedback"><?php echo $tele_err; ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <select type="checkbox" name="sex" class="form-control border-0 bg-light px-4 " placeholder="sex" style="height: 55px;" <?php echo (!empty($sex_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sex; ?>">
                                    <span class="invalid-feedback"><?php echo $sex_err; ?></span>
                                    <option value="sex"> sex</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="email" name="email" class="form-control border-0 bg-light px-4" placeholder="Email" style="height: 55px;" <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control border-0 bg-light px-4" placeholder="Mot de passe" style="height: 55px;" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="password" name="confirm_password" class="form-control border-0 bg-light px-4 " placeholder="Confirmer votre mot de passe" style="height: 55px;" <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
                        </div>

                        <div class="" style="width: 40%; border: 0.5px solid gray; margin-left: 30%" ></div>
                        <h1 style="font-size: 18; font-weight: 500;" >Matier a etudie:</h1>
                        <div class="form-group">
                            <div class="col-md-8">
                                <select type="checkbox" name="matiere" class="form-control border-0 bg-light px-4 " placeholder="Matiére a enseignez" style="height: 55px;" <?php echo (!empty($matiere_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $matiere; ?>">
                                    <span class="invalid-feedback"><?php echo $matiere_err; ?></span>
                                    <option value="Matiére a enseignez"> Matiére a enseignez</option>
                                    <?php
                                    $sql = "SELECT * FROM matiere";
                                    $result = mysqli_query($link, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['matiere'] ?><?php echo $row['type_mat'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                                <div style="display: flex; flex-direction: row;">

                                    <div>

                                        <select type="checkbox" name="matiere" class="form-control border-0 bg-light px-4 " placeholder="Matiére a enseignez" style="height: 55px;" <?php echo (!empty($matiere_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $matiere; ?>">
                                            <span class="invalid-feedback"><?php echo $matiere_err; ?></span>
                                            <option value="Matiére a enseignez"> Matiére a enseignez</option>
                                            <?php
                                            $sql = "SELECT * FROM matiere";
                                            $result = mysqli_query($link, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['matiere'] ?><?php echo $row['type_mat'] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">



                                        <select type="checkbox" name="matiere" class="form-control border-0 bg-light px-4 " placeholder="Matiére a enseignez" style="height: 55px;" <?php echo (!empty($matiere_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $matiere; ?>">
                                            <span class="invalid-feedback"><?php echo $matiere_err; ?></span>
                                            <option value="Matiére a enseignez"> Matiére a enseignez</option>
                                            <?php
                                            $sql = "SELECT * FROM matiere";
                                            $result = mysqli_query($link, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['matiere'] ?><?php echo $row['type_mat'] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <div>

                                            <select type="checkbox" name="matiere" class="form-control border-0 bg-light px-4 " placeholder="Matiére a enseignez" style="height: 55px;" <?php echo (!empty($matiere_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $matiere; ?>">
                                                <span class="invalid-feedback"><?php echo $matiere_err; ?></span>
                                                <option value="Matiére a enseignez"> Matiére a enseignez</option>
                                                <?php
                                                $sql = "SELECT * FROM matiere";
                                                $result = mysqli_query($link, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['matiere'] ?><?php echo $row['type_mat'] ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <div>

                                            <select type="checkbox" name="matiere" class="form-control border-0 bg-light px-4 " placeholder="Matiére a enseignez" style="height: 55px;" <?php echo (!empty($matiere_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $matiere; ?>">
                                                <span class="invalid-feedback"><?php echo $matiere_err; ?></span>
                                                <option value="Matiére a enseignez"> Matiére a enseignez</option>
                                                <?php
                                                $sql = "SELECT * FROM matiere";
                                                $result = mysqli_query($link, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['matiere'] ?><?php echo $row['type_mat'] ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>








                        <br>
                        <br>
                        <div class="form-group">
                            <input type="submit" name="send" id="btn" class="btn btn-primary" value="valider">
                            <a href="register.php" class="btn btn-dark">Annuler</a>
                        </div>
                </form>
            </div>
            <!-- Footer Start -->
            <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="container">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-6 footer-about">
                            <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
                                <a href="index.html" class="navbar-brand">
                                    <h1 class="m-0 text-white">ISG GABES</h1>
                                </a>
                                <p class="mt-3 mb-4">Notre service de tirage en ligne facilite la demmande d'impression de document pour les enseignants.</p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-6">
                            <div class="row gx-5">
                                <div class="col-lg-4 col-md-12 pt-5 mb-5">
                                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="bi bi-geo-alt text-primary me-2"></i>
                                        <p class="mb-0">Rue Jilani Habib, Gabès 6002</p>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="bi bi-envelope-open text-primary me-2"></i>
                                        <p class="mb-0">isggb@isggb.run.tn</p>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="bi bi-telephone text-primary me-2"></i>
                                        <p class="mb-0">+216 75 272 281</p>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">

                                </div>
                                <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid text-white" style="background: #061429;">
                <div class="container text-center">
                    <div class="row justify-content-end">
                        <div class="col-lg-8 col-md-6">
                            <div class="d-flex align-items-center justify-content-center" style="height: 75px;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->


            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


            <!-- JavaScript Libraries -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="lib/wow/wow.min.js"></script>
            <script src="lib/easing/easing.min.js"></script>
            <script src="lib/waypoints/waypoints.min.js"></script>
            <script src="lib/counterup/counterup.min.js"></script>
            <script src="lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="https://smtpjs.com/v3/smtp.js"></script>




            <!-- Template Javascript -->
            <script src="js/main.js"></script>
</body>

</html>