<?php
// Initialize the session
session_start();
// if (isset($_POST['login'])) {
//     # code...
// }
// Check if the user is already logged in, if yes then redirect him to welcome page
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     header("location: welcome.php");
//     exit;
// }

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
if (isset($_POST['username'])) :
    

    if (empty(trim($_POST["username"]))) {
        $username_err = "entrez.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement

        $admin = $_POST['username'];
        $passwordAdmin = $_POST['password'];
        // echo $admin;
        // echo $passwordAdmin;
        //DB
        $query = "select * from admin";
        $runQuery = mysqli_query($link, $query);
        $results = mysqli_fetch_assoc($runQuery);
        // echo $results['password'];
        // echo $results['userName'];
        if ($admin == $results['userName'] && $passwordAdmin == $results['password']) {
        header("location: admin.php");
        }else{

            $sql = "SELECT id, username, password FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = $username;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if username exists, if yes then verify password
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($password, $hashed_password)) {
                                // Password is correct, so start a new session
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                // Redirect user to welcome page
                                header("location: welcome.php");
                            } else {
                                // Password is not valid, display a generic error message
                                $login_err = " Mot de passe non valide.";
                            }
                        }
                    } else {
                        // Username doesn't exist, display a generic error message
                        $login_err = "Nom d’utilisateur ou mot de passe non valide.";
                    }
                } else {
                    echo "Oops! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
                
            }
        }

       
    }
endif;
    // Close connection
    mysqli_close($link);

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

    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <div class="nav-item dropdown">
                   
                        <a href="#" class="nav-link dropdown-toggle"style="font-size: 16px ;margin-right: 5px ; color:#fff;" data-toggle="dropdown"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></i></label>  téléphone</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="blog.html" class="dropdown-item">+216 75 272 281</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"style="font-size: 16px ;margin-right: 5px ; color:#fff;" data-toggle="dropdown"><label class="icon" for="email"><i class="fas fa-envelope"></i></label>  E-mail</a>
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
                    <h1 class="display-4 text-white animated zoomIn">Se connecter</h1>

                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Full Screen Search Start -->
    <div class="container-fluid pt-5">
        <div class="d-flex flex-column text-center mb-5 pt-5">
            <h1 class="display-4 m-0"> <span class="text-primary"></span></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 mb-5">
                <div class="contact-form">
                    <div id="success">
                        <div class="wrapper">
                            <?php
                            if (!empty($login_err)) {
                                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                            }
                            ?>

                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group">
                                    <div class="control-group">
                                        <input type="username" name="username" class="form-control p-4" id="username" placeholder="Nom et Prénom" required="required" data-validation-required-message="s'il vous plait entre votre nom et prénom" / <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="control-group">
                                        <input type="password" name="password" class="form-control p-4" id="password" placeholder=" Mot de passe" required="required" data-validation-required-message="Please enter a subject" / <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="btn-block">
                                        <p><a href="register.php">Crèer compte</a></p>
                                    </div>
                                    <p><a href="Nmdp.php"> Mot de passe oublier</a></p>
                                </div>

                                <div align="center">
                                    <input type="submit" name="login" class="btn btn-primary" value="connexion">

                                </div>
                        </div>
                    </div>
                    </form>
                </div>
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

                                <form action="">

                                </form>
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

                <!-- Template Javascript -->
                <script src="js/main.js"></script>
</body>

</html>