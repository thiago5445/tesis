<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}
?>

<?php include 'vista/plantillas/header.php'; ?>
<section class="main">
    <div class="wrapp">
        <?php include 'vista/plantillas/nav.php'; ?>
        <article>
            <div class="mensaje">
                <h2>CITAS</h2>
            </div>
            <div class="formulario">
                <label for="caja_busqueda">Buscar</label>
                <input type="text" name="caja_busqueda" id="caja_busqueda"></input>
                <a class="agregar" href="agregarcitas.php">Agregar Citas</a>
            </div>
            <hr>
            <div id="datos"></div>
            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/main.js"></script>
            <section>
        </article>
    </div>
</section>

<?php include 'vista/plantillas/footer.php'; ?>