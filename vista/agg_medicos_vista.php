<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

//CARGAR ESPECIALIDADES EN EL SELECT
$especialidad = $conexion -> prepare("SELECT * FROM especialidades");

$especialidad ->execute();
$especialidad = $especialidad ->fetchAll();
if(!$especialidad)
	$mensaje .= 'NO hay especialidades, por favor registre!';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Masajistas</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
</head>

<body>
    <?php include 'plantillas/header.php'; ?>
    <section class="main">
        <div class="wrapp">
            <?php include 'plantillas/nav.php'; ?>
            <article>
                <div class="mensaje">
                    <h2>TERAPISTA</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <h2>Agregar Terapista</h2>
                    <input required type="numeric" name="identificacion" placeholder="Cédula:" pattern="[0-9]+"
                        minlength="10" maxlength="13">
                    <input required type="text" name="nombres" placeholder="Nombres:" pattern="[a-zA-Z]+" minlength="3"
                        maxlength="20">
                    <input required type="text" name="apellidos" placeholder="Apellidos:" pattern="[a-zA-Z]+"
                        minlength="3" maxlength="20">
                    <input required type="email" name="correo" placeholder="Correo electrónico:">
                    <input required type="numeric" name="telefono" placeholder="Teléfono:" pattern="[0-9]+"
                        minlength="9" maxlength="10">
                    <label>Especialidad:</label>
                    <select required name="especialidad">
                        <option>Selecciona una opción</option>
                        <?php foreach ($especialidad as $Sql): ?>
                        <?php echo "<option value='". $Sql['espNombre']. "'>". $Sql['espNombre']. "</option>"; ?>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" name="enviar" value="Agregar Terapista">
                </form>
            </article>
    </section>
    <?php include 'plantillas/footer.php'; ?>
</body>

</html>