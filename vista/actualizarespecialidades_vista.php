<?php include 'plantillas/header.php'; ?>
<section class="main">
    <div class="wrapp">
        <?php include 'plantillas/nav.php'; ?>
        <article>
            <div class="mensaje">
                <h2>ESPECIALIDADES</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h2>EDITAR SERVICIO</h2><br />
                <input type="hidden" name="id" value="<?php echo $especialidad['idespecialidad'];?>">
                <input type="text" name="nombre" placeholder="Servicios:"
                    value="<?php echo $especialidad['espNombre'];?>" autofocus />
                <input type="submit" value="Actualizar Especialidad" />
                <?php  if(!empty($errores)): ?>
                <ul>
                    <?php echo $errores; ?>
                </ul>
                <?php  endif; ?>
            </form>
        </article>
</section>
<?php include 'plantillas/footer.php'; ?>
</body>

</html>