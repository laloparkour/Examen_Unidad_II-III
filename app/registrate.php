<?php

    session_start();
    include('database.php');
    include('functions.php');
    
    if (isset($_SESSION['email'])) {
        header('Location: ./index.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = stripslashes(trim($_POST['nombre']));
        $primer_apellido = trim($_POST['primer_apellido']);
        $segundo_apellido = trim($_POST['segundo_apellido']);
        $email = filter_var(trim(strtolower($_POST['email'])), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);
        $confirmar_password = trim($_POST['confirmar_password']);

        $errores = '';
        $mensaje = '';

        if (empty($nombre) || empty($primer_apellido) ||
            empty($segundo_apellido) || empty($email) ||
            empty($password) || empty($confirmar_password)) {
            $errores .= '<li class="list-group-item list-group-item-danger">Por favor rellena todos los datos correctamente</li>';
        } else {
            if (existe_usuario($email, $conn) != false)
                $errores .= '<li class="list-group-item list-group-item-danger">El nombre de usuario ya existe</li>';

            if ($password != $confirmar_password)
                $errores .= '<li class="list-group-item list-group-item-danger">Las contraseñas no son iguales</li>';

            if (strlen($password) < 8)
                $errores .= '<li class="list-group-item list-group-item-danger">La contraseña tiene que ser mayor a 8 caracteres</li>';
        }

        if ($errores == '') {
            try {
                if (insertar_usuario($nombre, $primer_apellido, $segundo_apellido, $email, $password, $conn))
                    $mensaje = '<li class="list-group-item list-group-item-success">Datos de la cuenta de usuario almacenados correctamente</li>';
            } catch (PDOException $e) {
                $errores .= '<li class="list-group-item list-group-item-danger">Ocurrió un error al intentar crear la cuenta de usuario</li>';
            }
		}

    }

    include '../views/registrate.view.php'

?>