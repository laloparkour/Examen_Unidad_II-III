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
            <div class="col-md-6">
                <h1 class="text-center">Realizar transacción</h1>
                <hr>
                
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" name="transaccion">
                    <label for="cuenta_destino" class="form-label fs-5 fw-bold">Cuenta destino</label>
                    <input type="text" class="form-control" name="cuenta_destino" id="cuenta_destino">
                    
                    <label for="cantidad" class="form-label fs-5 fw-bold">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" id="cantidad">
                    
                    <label for="descripcion" class="form-label fs-5 fw-bold">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion">
                    
                    <input type="hidden" name="cuenta_origen" value="<?php echo $id_cuenta?>">
                    <button type="button" class="btn btn-success mt-4 d-block w-100" onclick="transaccion.submit()">Realizar transacción</button>

                    <a class="btn btn-primary mt-3 d-block w-100" href="../app/ver_cuenta.php?id_cuenta=<?php echo $id_cuenta ?>">Regresar</a>
                    
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
                            
                </form>
                        
            </div>
        </div>
    </div>
</body>
</html>