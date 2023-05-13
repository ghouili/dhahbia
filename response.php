<?php
include 'config.php';
if(isset($_POST['get_byDate'])){
    if(!empty($_POST['get_byDate'])){
        $search = $_POST['get_byDate'].' 00:00:00';
        $s = $con->prepare("SELECT `id_imp`,`date`,`doc`,`ensignant` FROM `impression` WHERE `date`= ?");
        $s->bind_param('s', $search);
        $s->execute();
        $s->store_result();
        $s->bind_result($id_imp, $date, $doc, $ensignant);
        if($s->num_rows() >= 1){
            while($s->fetch()){
                $doc_arr = explode('/', $doc);
                echo '<tr>';
                echo '<td>'.$ensignant.'</td>';
                echo '<td>' . $id_imp . '</td>';
                echo '<td><a href="' . $doc . '">'.$doc_arr[2].'</a></td>';
                echo '<td>'.$date.'</td>';
                echo '</tr>';
            }
        }
    }
}
elseif(isset($_POST['get_byMatiere'])){
    if(!empty($_POST['get_byMatiere'])){
        $search = $_POST['get_byMatiere'];
        $s = $con->prepare("SELECT `id_imp`,`date`,`doc`,`ensignant` FROM `impression` WHERE `matiere`= ?");
        $s->bind_param('s', $search);
        $s->execute();
        $s->store_result();
        $s->bind_result($id_imp, $date, $doc, $ensignant);
        if($s->num_rows() >= 1){
            while($s->fetch()){
                $doc_arr = explode('/', $doc);
                echo '<tr>';
                echo '<td>' . $id_imp . '</td>';
                echo '<td><a href="' . $doc . '">'.$doc_arr[2].'</a></td>';
                echo '<td>'.$date.'</td>';
                echo '</tr>';
            }
        }
    }
}
elseif(isset($_POST['get_byAuditoire'])){
    if(!empty($_POST['get_byAuditoire'])){
        $search = $_POST['get_Auditoire'];
        $s = $con->prepare("SELECT `id_imp`,`date`,`doc`,`ensignant` FROM `impression` WHERE `auditoire`= ?");
        $s->bind_param('s', $search);
        $s->execute();
        $s->store_result();
        $s->bind_result($id_imp, $date, $doc, $ensignant);
        if($s->num_rows() >= 1){
            while($s->fetch()){
                $doc_arr = explode('/', $doc);
                echo '<tr>';
                echo '<td>' . $id_imp . '</td>';
                echo '<td></td>';
                echo '<td><a href="' . $doc . '">'.$doc_arr[2].'</a></td>';
                echo '<td>'.$date.'</td>';
                echo '</tr>';
            }
        }
    }
}
elseif(isset($_POST['get_bySemestre'])){
    if(!empty($_POST['get_bySemestre'])){
        $search = $_POST['get_Semestre'];
        $s = $con->prepare("SELECT `id_imp`,`date`,`doc`,`ensignant` FROM `impression` WHERE `semestre`= ?");
        $s->bind_param('s', $search);
        $s->execute();
        $s->store_result();
        $s->bind_result($id_imp, $date, $doc, $ensignant);
        if($s->num_rows() >= 1){
            while($s->fetch()){
                $doc_arr = explode('/', $doc);
                echo '<tr>';
                echo '<td>' . $id_imp . '</td>';
                echo '<td></td>';
                echo '<td><a href="' . $doc . '">'.$doc_arr[2].'</a></td>';
                echo '<td>'.$date.'</td>';
                echo '</tr>';
            }
        }
    }
}


?>