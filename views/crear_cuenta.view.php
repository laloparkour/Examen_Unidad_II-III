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
        p {
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
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-4">
                <h1 class="text-center">Agregar cuenta</h1>
                <hr>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" name="cuenta">
                    <label for="tipo_cuenta" class="form-label fs-5 fw-bold">Tipo de cuenta</label>
                    <select id="tipo_cuenta" name="tipo_cuenta" class="form-select">
                        <option value="Normal">Normal</option>
                        <option value="Premium">Premium</option>
                    </select>
                    <label for="cantidad" class="form-label fs-5 fw-bold">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" id="cantidad">
                    
                    <button type="button" class="btn btn-success mt-4 d-block w-100" onclick="cuenta.submit()">Agregar Cuenta</button>
                    
                    <?php if(!empty($errores)): ?>
                        <ul class="list-group">
                            <?php echo $errores?>
                        </ul>
                    <?php endif; ?>
                    <?php if(!empty($mensaje)): ?>
                        <ul class="list-group">
                            <?php echo $mensaje?>
                        </ul>
                    <?php endif; ?>

                    <a class="btn btn-primary mt-4 d-block w-100" href="../app/inicio.php">Regresar</a>
                    
                </form>
                        
            </div>

        </div>
                
    </div>
</body>
</html>