<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        h1 {
            text-align: center;
            margin-top: 35px;
        }

        .nombre {
            margin-top: 10px;
            text-align: center;
        }

        p > a {
            text-decoration: none;
        }

        label {
            margin-top: 10px;
        }

        .list-group {
            margin: 10px 0 10px 0;
        }

    </style>
</head>
<body class="bg-light">
    <div class="row row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="container">
                <h1>Hola!</h1>
                <p class="nombre fs-4 fw-bold"><?php echo $nombre . " " . $primer_apellido?></p>
        
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <div class="col-md-12 text-end mt-3">
                        <a class="btn btn-danger btn-lg" href="../app/logout.php">Cerrar sesión</a>
                        <a class="btn btn-success btn-lg" href="../app/crear_cuenta.php">+ Crear cuenta</a>
                    </div>
                </div>
        
                <div class="row mb-4 mt-3 justify-content-center">
                    <?php foreach($results as $result): ?>
                        <div class="col-6 border border-primary rounded p-2 mb-2">
                            <p class="fs-6 fw-bold">Número de cuenta: <?php echo $result->id ?></p>
                            <p class="fs-6 fw-bold">Cuenta: <?php echo $result->tipo_cuenta ?></p>
                            <p class="fs-6 fw-bold">Saldo: $<?php echo $result->cantidad ?></p>
                            <a class="btn btn-primary" href="ver_cuenta.php?id_cuenta=<?php echo $result->id ?>">Ver</a>
                            <div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        
            </div>
        </div>
    </div>
    
</body>
</html>