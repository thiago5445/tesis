<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Fiore di Lotto</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Antic" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
</head>

<body>
    <header>
        <div class="wrapp">
            <a href="index.php" title="Spa Fiore di Lotto">Fiore di Lotto<span>by Carlos Intriago</span></a>
            <div class="usuario">
                <a href="cerrar.php" title="Cerrar Sesion">Salir</a>
            </div>
            <div align="center">
                Bienvenido <?php echo $_SESSION["usuario"];?>
            </div>
        </div>
    </header>
</body>