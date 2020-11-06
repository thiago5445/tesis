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
                <label>Nombre:</label>
                <input type="text" name="nombres" placeholder="Nombre:" value="<?php echo $paciente['pacNombre'];?>">
                <label>Apellido:</label>
                <input type="text" name="apellidos" placeholder="Apellido:"
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
                <label>Teléfono:</label>
                <input type="numeric" name="telefono" placeholder="Teléfono:"
                    value="<?php echo $paciente['pacTelefono'];?>">
                <label>Dirección:</label>
                <input type="text" name="direccion" placeholder="Dirección:"
                    value="<?php echo $paciente['pacDireccion'];?>">
                    <label>Estado:</label>
                <select name="estado">
                    <option>Selecciona una opción</option>
                    if (<?php echo $medico['estado'];?>){
                    <option value="activo">activo</option>
                    <option value="inactivo">inactivo</option>
                    }
                </select>
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