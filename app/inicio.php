<?php 

    session_start();
    include('database.php');
    include('functions.php');

    if (isset($_SESSION['email'])) {
        $nombre = $_SESSION['nombre'];
        $primer_apellido = $_SESSION['primer_apellido'];
        $id_usuario = $_SESSION['id_usuario'];

        $results = vista_inicio($id_usuario, $conn);

        include '../views/inicio.view.php';
        
    } else {
        header('Location: login.php');
    }

?>