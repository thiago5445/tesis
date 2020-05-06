<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
?>

<?php include 'plantillas/header.php'; ?>
<section class="main">
    <div class="wrapp">
        <?php include 'plantillas/nav.php'; ?>
        <article>
            <div class="mensaje">
                <h2>CLIENTES</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h2>Actualizar clientes</h2><br>
                <label>Cédula:</label>
                <input type="hidden" name="id" value="<?php echo $paciente['idPaciente'];?>" />
                <input type="numeric" name="identificacion" placeholder="Cédula"
                    value="<?php echo $paciente['pacIdentificacion'];?>" requerid>
                <label>Nombres:</label>
                <input type="text" name="nombres" placeholder="Nombres:" value="<?php echo $paciente['pacNombre'];?>">
                <label>Apellidos:</label>
                <input type="text" name="apellidos" placeholder="Apellidos:"
                    value="<?php echo $paciente['pacApellidos'];?>">
                <label>Fecha:</label>
                <input type="date" name="fecha" placeholder="Fecha:"
                    value="<?php echo $paciente['pacFechaNacimiento'];?>" required />
                <label>Sexo:</label>
                <select name="sexo">
                    <option>Selecciona una opción</option>
                    if (<?php echo $paciente['pacSexo'];?>){
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                    }
                </select>
                <input type="numeric" name="telefono" placeholder="Teléfono:"
                    value="<?php echo $paciente['pacTelefono'];?>">
                <input type="text" name="direccion" placeholder="Dirección:"
                    value="<?php echo $paciente['pacDireccion'];?>">
                <input type="submit" name="enviar" value="Actualizar">
            </form>
            <?php  if(!empty($errores)): ?>
            <ul>
                <?php echo $errores; ?>
            </ul>
            <?php  endif; ?>
        </article>
</section>
<?php include 'plantillas/footer.php'; ?>
</body>

</html>