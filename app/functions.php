<?php 

    function existe_usuario($email, $conn) {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $results = $statement->fetch();

        return $results;
    }

    function existe_cuenta($cuenta_destino, $conn) {
        $sql = "SELECT * FROM cuentas WHERE id = :id_cuenta_destino";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id_cuenta_destino', $cuenta_destino);
        $statement->execute();
        $results = $statement->fetch();

        return $results;
    }

    function verificar_usuario($email, $password, $conn) {
        $sql = "SELECT * FROM usuarios WHERE email = :email AND password = :password";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->execute();
        $results = $statement->fetch();

        return $results;
    }

    function verificar_saldo($cuenta_origen, $conn) {
        // Verificamos que el saldo actual de la cuenta origen sea mayor a lo que queremos retirar
        $sql = "SELECT cantidad FROM cuentas WHERE id = :id_cuenta_origen";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id_cuenta_origen', $cuenta_origen);
        $statement->execute();
        $results = $statement->fetchColumn();

        return $results;
    }

    function obtener_saldo_actual($cuenta_destino, $conn) {
        $sql = "SELECT cantidad FROM cuentas WHERE id = :id_cuenta_destino";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id_cuenta_destino', $cuenta_destino);
        $statement->execute();
        $results = $statement->fetchColumn();

        return $results;

    }

    function obtener_saldo_y_tipo($cuenta_destino, $conn) {
        $sql = "SELECT tipo_cuenta, cantidad FROM cuentas WHERE id = :id_cuenta_destino";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id_cuenta_destino', $cuenta_destino);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_OBJ);

        return $results;

    }

    function actualizar_saldo_destino($nuevo_saldo, $cuenta_destino, $conn) {
        $sql = "UPDATE cuentas SET cantidad = :nuevo_saldo WHERE id = :id_cuenta_destino";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':nuevo_saldo', $nuevo_saldo);
        $statement->bindParam(':id_cuenta_destino', $cuenta_destino);
        $statement->execute();

        return $statement;
    }

    function actualizar_saldo_origen($nuevo_saldo, $cuenta_origen, $conn) {
        $sql = "UPDATE cuentas SET cantidad = :nuevo_saldo WHERE id = :id_cuenta_origen";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':nuevo_saldo', $nuevo_saldo);
        $statement->bindParam(':id_cuenta_origen', $cuenta_origen);
        $statement->execute();

        return $statement;
    }

    function insertar_usuario($nombre, $primer_apellido, $segundo_apellido, $email, $password, $conn) {
        $sql = 'CALL SP_CREATE_USER_PROFILE(:nombre, :primer_apellido, :segundo_apellido, :email, :password)';
        $statement = $conn->prepare($sql);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':primer_apellido', $primer_apellido);
        $statement->bindParam(':segundo_apellido', $segundo_apellido);
        $statement->bindParam(':email', $email);
        $password = hash('sha512', $password);
        $statement->bindParam(':password', $password);
        $statement->execute();

        return $statement;
    }

    function insertar_cuenta($tipo_cuenta, $cantidad, $id_usuario, $conn) {
        $sql = 'CALL SP_OPEN_ACCOUNT(:tipo_cuenta, :cantidad, :usuario_id)';
        $statement = $conn->prepare($sql);
        $statement->bindParam(':tipo_cuenta', $tipo_cuenta);
        $statement->bindParam(':cantidad', $cantidad);
        $statement->bindParam(':usuario_id', $id_usuario);
        $statement->execute();

        return $statement;
    }

    function insertar_movimiento($cuenta_origen, $cuenta_destino, $cantidad, $descripcion, $conn) {
        $sql = 'CALL SP_REGISTER_MOVEMENT(:cuenta_origen, :cuenta_destino, :cantidad, :descripcion, NOW())';
        $statement = $conn->prepare($sql);
        $statement->bindParam(':cuenta_origen', $cuenta_origen);
        $statement->bindParam(':cuenta_destino', $cuenta_destino);
        $statement->bindParam(':cantidad', $cantidad);
        $statement->bindParam(':descripcion', $descripcion);
        $statement->execute();

        return $statement;
    }

    // Aun no se implementa la vista a esta query
    function vista_inicio($id_usuario, $conn) {
        $sql = "SELECT id, tipo_cuenta, cantidad 
        FROM cuentas 
        WHERE usuario_id = :id_usuario";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id_usuario', $id_usuario);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_OBJ);

        return $results;
    }

    // Aun no se implementa la vista a esta query
    function vista_ver_cuenta($id_usuario, $id_cuenta, $conn) {
        $sql = "SELECT cuentas.id, tipo_cuenta, cuentas.cantidad, MAX(fecha) as ultimo_movimiento 
        FROM cuentas
        JOIN movimientos
        ON cuentas.id = movimientos.cuenta_origen
        WHERE usuario_id = :id_usuario AND cuentas.id = :id_cuenta;";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id_usuario', $id_usuario);
        $statement->bindParam(':id_cuenta', $id_cuenta);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_OBJ);

        return $results;
    }

    // Aun no se implementa la vista a esta query
    function vista_listado_movimientos($id_cuenta, $conn) {
        $sql = "SELECT fecha, descripcion, cantidad, cuenta_origen, cuenta_destino 
        FROM movimientos 
        WHERE cuenta_origen = :cuenta_origen 
        OR cuenta_destino = :cuenta_destino 
        ORDER BY fecha DESC";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':cuenta_origen', $id_cuenta);
        $statement->bindParam(':cuenta_destino', $id_cuenta);
        $statement->execute();
        $resultados = $statement->fetchAll(PDO::FETCH_OBJ);

        return $resultados;
    }

?>