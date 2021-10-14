<?php

    session_start();
    include('database.php');
    include('functions.php');

    $id_usuario = $_SESSION['id_usuario'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
        $tipo_cuenta = $_POST['tipo_cuenta'];
        $cantidad = trim($_POST['cantidad']);

        $errores = '';
        $mensaje = '';

        if (empty($cantidad)) {
            $errores .= '<li class="list-group-item list-group-item-danger">Por favor rellena todos los datos correctamente</li>';
        }

        if (!is_numeric($cantidad)) {
            $errores .= '<li class="list-group-item list-group-item-danger">La cantidad debe de ser un número</li>';
        }

        if ($tipo_cuenta == 'Normal' && $cantidad > 10000) {
            $errores .= '<li class="list-group-item list-group-item-danger">Límite de cantidad excedido</li>';
        }

        if ($errores == '') {
            try {
                if (insertar_cuenta($tipo_cuenta, $cantidad, $id_usuario, $conn))
                $mensaje = '<li class="list-group-item list-group-item-success">Cuenta creada exitosamente</li>';
            } catch (PDOException $e) {
                $errores .= '<li class="list-group-item list-group-item-danger">No fue posible almacenar los datos, favor de revisar la información</li>';
            }
		}
        
    }
    
    include '../views/crear_cuenta.view.php';

?>