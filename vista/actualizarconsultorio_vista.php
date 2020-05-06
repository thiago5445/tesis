<?php include 'plantillas/header.php'; ?>
<section class="main">
    <div class="wrapp">
        <?php include 'plantillas/nav.php'; ?>
        <article>
            <div class="mensaje">
                <h2>CONSULTORIOS</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h2>EDITAR CONSULTORIO</h2><br />
                <input type="hidden" name="id" value="<?php echo $consultorio['idConsultorio'];?>">
                <input type="text" name="nombre" placeholder="Consultorios:"
                    value="<?php echo $consultorio['conNombre'];?>" autofocus />
                <input type="submit" value="Actualizar Consultorio" />
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