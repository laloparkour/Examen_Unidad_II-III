<?php

    session_start();
    include('database.php');
    include('functions.php');

    $nombre = $_SESSION['nombre'];
    $primer_apellido = $_SESSION['primer_apellido'];
    $id_usuario = $_SESSION['id_usuario'];

    $id_cuenta = $_GET['id_cuenta'];

    // Mostrar la cuenta con la fecha del ultimo movimiento realizado
    $results = vista_ver_cuenta($id_usuario, $id_cuenta, $conn);
    
    // Mostrar tabla con todos los movimientos de la cuenta
    $resultados = vista_listado_movimientos($id_cuenta, $conn);

    include '../views/ver_cuenta.view.php';

?>