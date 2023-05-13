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
    <style>
       select {
  margin-right: 150px;
  
  
}

    </style>
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
                    <a href="welcome.php" class="nav-item nav-link">Les Demendes</a>
                </div>
            </div>
        </nav>
        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Historique</h1>

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


    <!-- Testimonial Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
    
                <label for="">Semestre </label>
<select id="select_semestre">
    <option value="">Select semestre</option>
<?php
    include "config.php";
    $x = $con->prepare("SELECT DISTINCT(semestre) FROM impression");
    $x->execute();
    $x->store_result();
    $x->bind_result($select_semestre);
    while($x->fetch()){
        echo '
            <option value="'.$select_semestre.'">'.$select_semestre.'</option>
        ';
    }

?>
</select>

<label for="">Auditoire</label>
<select id="select_auditoire">
    <option value="">Select auditoire</option>
<?php
    include "config.php";
    $x = $con->prepare("SELECT DISTINCT(auditoire) FROM impression");
    $x->execute();
    $x->store_result();
    $x->bind_result($select_auditoire);
    while($x->fetch()){
        echo '
            <option value="'.$select_auditoire.'">'.$select_auditoire.'</option>
        ';
    }

?>
</select>
            <label for="">Matière</label>
<select id="select_matiere">
    <option value="">Select Matiere</option>
<?php
    include "config.php";
    $x = $con->prepare("SELECT DISTINCT(matiere) FROM impression");
    $x->execute();
    $x->store_result();
    $x->bind_result($select_matiere);
    while($x->fetch()){
        echo '
            <option value="'.$select_matiere.'">'.$select_matiere.'</option>
        ';
    }

?>

</select>
       
<br>

<br>
<br>
        <table class="table table-striped">

    
<tr>
<thead>

  <th>Id_impression</th>
  <th>document</th>
  <th>date</th>
</tr>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
</thead>
<tbody id="matiere_body">

<?php
$s = $con->prepare("SELECT `id_imp`,`date`,`doc` FROM `impression`");
$s->execute();
$s->store_result();
$s->bind_result($id_imp, $date, $doc);
if($s->num_rows() >= 1){
    while($s->fetch()){
        $doc_arr = explode('/', $doc);
        echo '<tr>';
            echo '<td>' . $id_imp . '</td>';
            echo '<td><a href="' . $doc . '">'.$doc_arr[2].'</a></td>';
            echo '<td>' . $date . '</td>';
        echo '</tr>';
    }
}
?>


<?php
$sql = "SELECT * FROM archive_imp";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)){
?>
<tr>
<td>
  <a href="<?php echo $row['doc']?>" download><?php echo basename($row['doc'])?></a>
</td>
<td><?php echo $row['date']?></td>
</tr>
<?php
}
?>
</tbody>

</table>

                            
      </div>
      </div>
    <!-- Testimonial End -->


    <!-- Vendor Start -->
   
    <!-- Vendor End -->
    

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
