<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
	<?php
		if ($_POST) {
			$accion = $_POST['accion'];

			function ejecutar_query($sql){
				include 'conexion.php';
				if ($conexion->query($sql) === TRUE) {
			        return 'ok';
			    } else {
			        echo "Error: " . $conn->error;
			    }
			    $conn->close();
			}

			$id = (isset($_POST["id"])) ? $_POST["id"] : '';
			$fecha = (isset($_POST["fecha"])) ? $_POST["fecha"] : '';
			$gasto = (isset($_POST["gasto"])) ? $_POST["gasto"] : '';
			$tipo = (isset($_POST["tipo"])) ? $_POST["tipo"] : '';
			$monto = (isset($_POST["monto"])) ? $_POST["monto"] : '';

			switch ($accion) {
				case 'agregar':
				    $sql = "INSERT INTO colombia VALUES ('', now(), '$gasto', '$tipo', '$monto')";
				    if (ejecutar_query($sql) == 'ok') {
	?>
	  				<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Listo !!!',
                                text: 'Agregado Exitosamente!'
                            }).then(function() {
                                window.location = "index.php";
                            });
                    </script>
    <?php
				    }
				    break;
			}
		}

		else{
	?>
			<script type="text/javascript">
				Swal.fire({
				icon: "error",
				title: "Oops...",
				text: "No tienes Permuiso!"
				}).then(function() {
			    window.location = "index.php";
			    });
				</script>
	<?php
		}
	?>
</body>