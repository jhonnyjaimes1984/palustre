<?php 
session_start();
session_destroy();

if(isset($_GET["urdt"]) && $_GET["urdt"]=='400'){ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Log In</title>

    <!-- Bootstrap 4.5 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- FontAwesome (Iconos) -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 10px;
            font-size: 1.1rem;
        }
        .text-muted {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="card">
        <div class="card-header">
            <i class="fas fa-database"></i> Database Palustre
        </div>
        <div class="card-body">
            <div class="text-center mb-3">
                <img src="../image/imagen_2.png" alt="Logo" width="200" height="200" style="border-radius: 10px;">
            </div>

            <h3 class="text-center mb-4">Log in</h3>

            <form action="validator.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Ej: usuario@email.com" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    <i class="fas fa-sign-in-alt"></i> Sing in
                </button>
            </form>

            <p class="text-center text-muted mt-3">
                Forgot your password? <a href="#"> Reset password</a>
            </p>
        </div>
    </div>
</div>

<!-- SweetAlert2 - Mostrar Alerta -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Invalid email or password"
        });
    });
</script>

</body>
</html>
<?php } else { ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Log In</title>

    <!-- Bootstrap 4.5 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 10px;
            font-size: 1.1rem;
        }
        .text-muted {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="card">
        <div class="card-header">
            <i class="fas fa-database"></i> Database Palustre
        </div>
        <div class="card-body">
            <div class="text-center mb-3">
                <img src="../image/imagen_2.png" alt="Logo" width="200" height="200" style="border-radius: 10px;">
            </div>

            <h3 class="text-center mb-4">Log in</h3>

            <form action="validator.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Ej: usuario@email.com" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    <i class="fas fa-sign-in-alt"></i> Sing in
                </button>
            </form>

            <p class="text-center text-muted mt-3">
                Forgot your password? <a href="#"> Reset password</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>

<?php } ?>
