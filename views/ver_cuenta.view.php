<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver cuenta</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>

        .cursor {
            cursor: default;
        }
    </style>
</head>
<body class="bg-light">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="container">
                <div class="row d-flex flex-wrap align-items-center justify-content-center">
                    <h1 class="mt-5 text-center">Detalles de cuenta</h1>
                    <div class="col-md-12 mt-5">
                        <div class="d-flex">
                            <a class="btn btn-primary me-auto btn-lg" href="../app/inicio.php">Regresar</a>
                            <a class="btn btn-light cursor fs-5 fw-bold" disabled><?php echo $nombre . " " . $primer_apellido?></a>
                            <a class="btn btn-danger btn-lg" href="../app/logout.php">Cerrar sesión</a>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <a class="btn btn-success btn-lg" href="../app/realizar_transaccion.php?id_cuenta=<?php echo $id_cuenta ?>">Realizar transacción</a>
                        </div>
                    </div>
                </div>
        
                <?php foreach($results as $result): ?>
                    <div class="row mb-4 mt-4 d-flex border border-2 border-primary rounded">
                        <div class="col-5 align-self-center ">
                            <p class="fs-5 fw-bold">Número de cuenta: <?php echo $result->id ?></p>
                            <p class="fs-5 fw-bold">Cuenta: <?php echo $result->tipo_cuenta ?></p>
                            <p class="fs-5 fw-bold">Saldo: $<?php echo $result->cantidad ?></p>
                        </div>
                        <div class="col-7 align-self-center">
                            <p class="fs-5 fw-bold">Ultimo movimiento <?php echo $result->ultimo_movimiento?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Depósitos</th>
                            <th>Retiros</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultados as $result): ?>
                            <tr>
                                <td><?php echo $result->fecha ?></td>
                                <td><?php echo $result->descripcion ?></td>
                                <?php if ($result->cuenta_destino == $id_cuenta): ?>
                                    <td>$<?php echo $result->cantidad ?></td>
                                    <td></td>
                                <?php elseif ($result->cuenta_origen == $id_cuenta): ?>
                                    <td></td>
                                    <td>$<?php echo $result->cantidad ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>