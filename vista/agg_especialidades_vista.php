<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>SERVICIOS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Servicios</h2>
                        <input requerid type="text" name="nombre" placeholder="Servicio:"  pattern="[a-zA-Z]+">
						<input type="submit" name="enviar" value="Agregar Servicio">
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