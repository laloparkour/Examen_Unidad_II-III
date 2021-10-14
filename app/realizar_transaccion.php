<?php

   session_start();
    include('database.php');
    include('functions.php');
    
    // Si voy a realizar una transaccion tengo que tener el numero de cuenta de donde realizo la transaccion.
    $id_usuario = $_SESSION['id_usuario'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
        $cuenta_destino = trim($_POST['cuenta_destino']);
        $cantidad = trim($_POST['cantidad']);
        $descripcion = trim($_POST['descripcion']);
        
        $cuenta_origen = $_POST['cuenta_origen'];
        $id_cuenta = $_POST['cuenta_origen'];

        $errores = '';
        $mensaje = '';
        
        if (empty($cuenta_destino)|| empty($cantidad) || empty($descripcion)) {
            $errores .= '<li class="list-group-item list-group-item-danger">Por favor rellena todos los datos correctamente</li>';
        }else {
            if (!is_numeric($cuenta_destino) || !is_numeric($cantidad))
                $errores .= '<li class="list-group-item list-group-item-danger">Datos incorrectos</li>';

            // validar que la cuenta de destino no sea la misma que la de origen
            if ($cuenta_destino != $cuenta_origen) {
        
                // Se valida que la cuenta destino exista
                if (existe_cuenta($cuenta_destino, $conn) !== false) {
                    $results = verificar_saldo($cuenta_origen, $conn);
                    
                    if (round($cantidad, 2) < 0.01) {
                        $errores .= '<li class="list-group-item list-group-item-danger">La cantidad de transferencia es invalida</li>';
                    } else {
                        if ($results < $cantidad) {
                            $errores .= '<li class="list-group-item list-group-item-danger">No fue posible realizar la transacción</li>';
                        } else {
                            //Obtenemos el saldo actual de la cuenta a depositar
                            $results = obtener_saldo_y_tipo($cuenta_destino, $conn);

                            foreach($results as $result) {
                                $tipo_de_cuentilla = $result->tipo_cuenta;
                                $saldito_actual = $result->cantidad;
                            }

                            echo "el tipo de cuenta es: " . $tipo_de_cuentilla . "y el saldo actual es de: " . $saldito_actual; 

                            $total = $cantidad + $saldito_actual;

                            echo "el total es: " . $total;

                            $saldo_actual = $saldito_actual;

                            // Validar que la cuenta a la que intentamos transferir si es normal no se le pueda transferir mas del limite (10000)
                            if ($tipo_de_cuentilla == 'Normal' && $total > 10000) {
                                $errores .= '<li class="list-group-item list-group-item-danger">Límite de cuenta excedido';
                            } else {
                                // Realizamos la operacion del deposito a la cuenta destino
                                $nuevo_saldo = $saldito_actual + $cantidad;
                    
                                try {
                                    // Se actualiza el nuevo_saldo en la BD
                                    if (actualizar_saldo_destino($nuevo_saldo, $cuenta_destino, $conn)) {
                                        insertar_movimiento($cuenta_origen, $cuenta_destino, $cantidad, $descripcion, $conn);
                    
                                        // Restamos la cantidad depositada a la cuenta origen. Para eso tendremos que obtener
                                        // la cantidad actual de la cuenta origen
                                        $results = verificar_saldo($cuenta_origen, $conn);
                        
                                        // Realizamos la operacon del retiro a la cuenta origen
                                        $saldo_actual = $results;
                                        $nuevo_saldo = $saldo_actual - $cantidad;
                    
                                        // Se actualiza el nuevo_saldo en la BD
                                        actualizar_saldo_origen($nuevo_saldo, $cuenta_origen, $conn);
                    
                                        $mensaje = '<li class="list-group-item list-group-item-success">Transferencia realizada con éxito</li>';
                                    }
                                } catch (PDOException $e) {
                                    $errores .= '<li class="list-group-item list-group-item-danger">Ocurrio un error al realizar la transacción</li>';
                                }

                            }
            
                        }

                    }
                } else {
                    $errores .= '<li class="list-group-item list-group-item-danger">El número de cuenta no existe</li>';
                }
    
            } else {
                $errores .= '<li class="list-group-item list-group-item-danger">El número de cuenta debe de ser diferente</li>';
            }
        }
        
    } else if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET['id_cuenta'])) {
            header("Location: inicio.php");
        }else {

            $id_cuenta = $_GET['id_cuenta'];
        }

    }

    include '../views/realizar_transaccion.view.php';

?>