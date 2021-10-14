<?php 

    session_start();
    include('database.php');
    include('functions.php');

    if (isset($_SESSION['email'])) {
        header('Location: ../index.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $errores = '';
        
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = filter_var(trim(strtolower($_POST['email'])), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);
            $password = hash('sha512', $password);

            $results = verificar_usuario($email, $password, $conn);

            if ($results !== false) {
                $_SESSION['email'] = $results['email'];
                $_SESSION['nombre'] = $results['nombre'];
                $_SESSION['primer_apellido'] = $results['primer_apellido'];
                $_SESSION['id_usuario'] = $results['id'];
                header('Location: ../index.php');
            } else {
                $errores .= '<li class="list-group-item list-group-item-danger">Email o contraseña incorrectos</li>';
            }
            
        } else {
            $errores .= '<li class="list-group-item list-group-item-danger">Campos vacíos</li>';
        }

    }
    
    include '../views/login.view.php';

?>

<script></script>