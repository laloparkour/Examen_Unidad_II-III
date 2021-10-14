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
            margin: 10px 0 10px 0;
        }
    </style>
</head>
<body >
    
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-6">
                <img src="../assets/img/uabcs.jpeg" width="230px" alt="logo_uabcs" class="mx-auto d-block">
                <h1>Iniciar Sesión</h1>
                <hr>
                
                <form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" name="login">
                    <label for="email" class="form-label fs-5 fw-bold">Correo</label>
                    <input type="email" class="form-control" name="email" id="email">
                    <label for="password" class="form-label fs-5 fw-bold">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password">                   
                    
                    <button type="button" class="btn btn-primary btn-lg mt-4 d-block mx-auto" onclick="login.submit()">Iniciar sesión</button>
    
                    <?php if(!empty($errores)): ?>
                        <ul class="list-group">
                            <?php echo $errores?>
                        </ul>
                    <?php endif; ?>
                            
                </form>
                <p fs-5 class="fw-bold">¿Aún no tienes cuenta?<a href="../app/registrate.php">   Regístrate</a></p>
            </div>
        </div>
    </div>
    
</body>
</html>