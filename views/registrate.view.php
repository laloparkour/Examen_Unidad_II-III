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
            margin-top: 10px;
        }
        
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
            margin: 5px 0 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-6">
                <img src="../assets/img/uabcs.jpeg" width="200px" alt="logo_uabcs" class="mx-auto d-block">
                <h1 >Registrarse</h1>
                <hr>
                    
                <form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" name="registro">
                    <label for="nombre" class="form-label fs-5 fw-bold">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                    <label for="primer_apellido" class="form-label fs-5 fw-bold">Primer Apellido:</label>
                    <input type="text" class="form-control" name="primer_apellido" id="primer_apellido">
                    <label for="segundo_apellido" class="form-label fs-5 fw-bold">Segundo Apellido:</label>
                    <input type="text" class="form-control" name="segundo_apellido" id="segundo_apellido">
                    <label for="email" class="form-label fs-5 fw-bold">Correo:</label>
                    <input type="email" class="form-control" name="email" id="email">
                    <label for="password" class="form-label fs-5 fw-bold">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <label for="confirmar_password" class="form-label fs-5 fw-bold">Confirmar Contraseña:</label>
                    <input type="password" class="form-control" name="confirmar_password" id="confimar_password">                      
                    
                    <button type="button" class="btn btn-primary btn-lg mt-3 d-block mx-auto" onclick="registro.submit()">Registrarse</button>
                    
                    <p class="fs-5 fw-bold">¿Ya tienes cuenta?<a href="../app/login.php">   Iniciar Sesión</a></p>

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