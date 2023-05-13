<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$ensignant =$semestre =  $matiere = $niveau = $filiere = $auditoire = $nb_etudient = $nb_page = $date = $type_imp = "";
$ensignant_err = $semestre_err = $matiere_err = $niveau_err = $filiere_err = $auditoire_err = $nb_etudient_err = $nb_page_err = $date_err = $type_imp_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ensignant = $_POST["username"];

    // Validate matiere
    $matiere = $_POST["semestre"];
    $matiere = $_POST["matiere"];
    $niveau = $_POST["niveau"];
    $filiere = $_POST["filiere"];
    // Validate auditoire
    if (empty(trim($_POST["auditoire"]))) {
        $auditoire_err = "Please enter a auditoire.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["auditoire"]))) {
        $auditoire_err = "filiere can only contain letters, numbers, and underscores.";
    } else {
        $auditoire = $_POST["auditoire"];
    }

    // Validate nb_etudient
    if (empty(trim($_POST["nb_etudient"]))) {
        $nb_etudient_err = "Please enter a number of students.";
    } elseif (strlen(trim($_POST["nb_etudient"])) < 1) {
        $nb_etudient_err = "Number of students must have at least 1 character.";
    } else {
        $nb_etudient = trim($_POST["nb_etudient"]);
    }

    // Validate nb_page
    if (empty(trim($_POST["nb_page"]))) {
        $nb_page_err = "Please enter a number of pages.";
    } elseif (strlen(trim($_POST["nb_page"])) < 1) {
        $nb_page_err = "Number of pages must have at least 1 character.";
    } else {
        $nb_page = trim($_POST["nb_page"]);
    }

    // Validate date
    if (empty(trim($_POST["date"]))) {
        $date_err = "Please enter a date.";
    } elseif (!strtotime(trim($_POST["date"]))) {
        $date_err = "Please enter a valid date.";
    } else {
        $date = $_POST["date"];
    }
    $type_imp = $_POST["type_imp"];
    $path  = "./document/";
    $fileName = $_FILES['document']['name'];
    if (file_exists($path)) {
        move_uploaded_file($_FILES['document']['tmp_name'], $path . $fileName);
    } else {
        mkdir($path);
        move_uploaded_file($_FILES['document']['tmp_name'], $path . $fileName);
    }
    $doc = $path . $_FILES['document']['name'];
    echo $doc;
    if (empty($ensignant_err) && empty($matiere_err) && empty($niveau_err) && empty($filiere_err) && empty($auditoire_err) && empty($nb_etudient_err) && empty($nb_page_err) && empty($date_err) && empty($type_imp_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO impression (ensignant, semestre, matiere, niveau,filiere,auditoire,nb_etudient,nb_page, date ,type_imp, doc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($link, $sql)) {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssissssssss", $ensignant, $semestre, $matiere, $niveau, $filiere, $auditoire, $nb_etudient, $nb_page, $date, $type_imp, $doc);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                // Redirect to login pages
                //header("location: login.php");
                echo "fdvdf";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

        //fill in table history with 
        $sql = "INSERT INTO archive_imp (id_imp, id_user, action_type, doc,date) VALUES (?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($link, $sql)) {

            // Bind variables to the prepared statement as parameters
            $action_type = 'demande tirage';
            $id_doc = null;
            mysqli_stmt_bind_param($stmt, "sssss", $id_doc, $_SESSON["id"],  $action_type, $doc, date("h:i:sa"));

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                // Redirect to login pages
                //header("location: login.php");
                echo "fdvdf";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        //  if ($stmt = mysqli_prepare($link, $sql)) {
        //     $_SESSION[" id_users"]= $id;
        //     $_SESSION["demade tirage"]= $action_type ;
        //      $_SESSION["doc"]= $doc ;
        //      $_SESSION["date"]= $date  ;
        //fill in table history with (id_user, action_type, docs, time);
        // id_user = $_SESSON["id"];
        // action_type = "demande tirage" / "tirage"
        // doc = $doc
        //time = date("h:i:sa")
    } else {
        echo "error";
    }
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
    <style>
        .hide {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner">
        </div>
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


    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="index.php" class="logo">
                <img src="https://isggb.rnu.tn/frontoffice/assets/images/logoIsggb.png" alt="IMG-LOGO" style="padding: 10px;">
            </a>


            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="hisens.php" class="nav-item nav-link">Historique</a>
                    <a href="logout.php" class="nav-item nav-link">Déconnexion</a>
                </div>
            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="my-5">Bonjour, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></br>soyez le bienvenu</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->
    <!-- Features Start -->
    <div align="center">
        <div class="row g-5">
            <div class="col-lg-12 wow slideInUp" data-wow-delay="0.3s">
                <div class="container-fluid bg-light pt-5 pb-4">
                    <div class="container py-5">
                        <div class="d-flex flex-column text-center mb-5">
                            <h1 class="display-4 m-0"><span class="text-primary"></span></h1>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>">
                            <h4> Semestre<span1>*</span1>
                            </h4>
                            <select name="semestre" class="select1" onchange="toggleSelects()">
                                <span class="invalid-feedback"><?php echo $semestre_err; ?></span>
                                <option value="semestre 1"> Semestre 1</option>
                                <option value="semestre 2">Semestre 2</option>
                            </select>

                            
                            <h4> Niveaux<span1>*</span1>
                            </h4>
                            <select name="niveau" class="select1" onchange="toggleSelects()">
                                <span class="invalid-feedback"><?php echo $niveau_err; ?></span>
                                <?php
                                $sql = "SELECT * FROM niveau";
                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value="<?php echo $row['id_niveau'] ?>er cycle"><?php echo $row['lib_niveau'] ?> </option>
                                <?php
                                }
                                ?>
                            </select>

                            </br>
                            <h4>Filière<span1>*</span1>
                            </h4>
                            <select name="filiere" class="select2">
                                <span class="invalid-feedback"><?php echo $filiere_err; ?></span>
                                <option value="licence en gestion"> licence en gestion</option>
                                <option value="licence en économie">licence en économie</option>
                                <option value="licence en informatique de gestion">licence en informatique de gestion</option>
                            </select>
                            <select name="filiere" class="select3 hide">
                                <span class="invalid-feedback"><?php echo $filiere_err; ?></span>
                                <option value="Mastère de recherche"> Mastère de recherche</option>
                                <option value="Mastère proffessionnel">Mastère proffessionnel</option>
                            </select>
                            </br>
                            <h4>Auditoire<span1>*</span1>
                            </h4>
                            <select name="auditoire">
                                <span class="invalid-feedback"><?php echo $auditoire_err; ?></span>
                                <?php
                                $sql = "SELECT * FROM auditoire";
                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value="<?php echo $row['id_audit'] ?>"><?php echo $row['lib_audit'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            </br>
                            <h4>Matière<span1>*</span1>
                            </h4>
                            <select name="matiere">
                                <span class="invalid-feedback"><?php echo $matiere_err; ?></span>
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
                            </br>

                            <h4>Nombre de étudients<span1>*</span1>
                            </h4>
                            <input type="text" name="nb_etudient">
                            <span class="invalid-feedback"><?php echo $nb_etudient_err; ?></span>
                            </br>

                            <h4>Nombre de pages<span1>*</span1>
                            </h4>
                            <input type="text" name="nb_page">
                            <span class="invalid-feedback"><?php echo $nb_page_err; ?></span>
                            </br>

                            <h4> Date<span1>*</span1>
                            </h4>
                            <input id="date" type="datetime-local" name="date">
                            <span class="invalid-feedback"><?php echo $date_err; ?></span>
                            </br>

                            <h4>Type d'impression<span1>*</span1>
                            </h4>
                            <div align="left">
                                <label for="radio_5" class="radio"> Recto</label>
                                <input type="radio" value="Recto" id="radio_5" name="type_imp" <?php echo (!empty($type_imp_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $type_imp; ?>">
                                <span class="invalid-feedback"><?php echo $type_imp_err; ?></span>
                                <br>

                                <label for="radio_5" class="radio">Recto-verso</label>
                                <input type="radio" name="type_imp" value="Recto-verso" <?php echo (!empty($type_imp_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $type_imp; ?>">
                                <span class="invalid-feedback"><?php echo $type_imp_err; ?></span>
                            </div>
                            </br>

                            <h4>Ajouter document<span1 class="text3-primary">*</span1></a></h4>
                            <input type="file" name="document">
                            </br>
                            </br>

                            <div class="form-group">

                                <input type="submit" class="btn btn-primary" value="valide">
                                <a href="welcome.php" class="btn btn-dark">Annuler</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </table>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Features Start -->

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

        <!-- <script src="js/master.js"></script> -->
        <script src="./js/script.js"></script>
</body>

</html>