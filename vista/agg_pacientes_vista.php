<?php include 'plantillas/header.php'; ?>
<section class="main">
    <div class="wrapp">
        <?php include 'plantillas/nav.php'; ?>
        <article>
            <div class="mensaje">
                <h2>CLIENTES</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h2>Agregar Cliente</h2>
                <input required type="numeric" name="identificacion" placeholder="Cédula:" pattern="[0-9]+"
                        minlength="10" maxlength="13">
                <input required type="text" name="nombres" placeholder="Nombres:" pattern="[a-zA-Z]+" minlength="3"
                    maxlength="20">
                <input required type="text" name="apellidos" placeholder="Apellidos:" pattern="[a-zA-Z]+" minlength="3"
                    maxlength="20">
                <input required type="date" name="fechaNacimiento" placeholder="Fecha Nacimiento:">
                <select name="sexo">
                    <option>Selecciona una opción</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
                <input required type="numeric" name="telefono" placeholder="Teléfono:" pattern="[0-9]+" minlength="9"
                    maxlength="10">
                <input required type="text" name="direccion" placeholder="Direccion:" pattern="[a-zA-Z]+" minlength="3"
                    maxlength="20">
                <input type="submit" name="enviar" value="Agregar Cliente">
            </form>
            <?php  if(!empty($errores)): ?>
            <ul>
                <?php echo $errores; ?>
            </ul>
            <?php  endif; ?>
        </article>
</section>
<?php include 'plantillas/footer.php'; ?>