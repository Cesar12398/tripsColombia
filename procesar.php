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
			$gasto = (isset($_POST["gasto"])) ? $_POST["gasto"] : '';
			$monto = (isset($_POST["monto"])) ? $_POST["monto"] : '';

			switch ($accion) {
				case 'agregar':
				    $sql = "INSERT INTO colombia VALUES ('', '$gasto', '$monto')";
				    if (ejecutar_query($sql) == 'ok') {
	?>
	  				<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Listo !!!',
                                text: '<?php echo $gasto ?> Agregado Exitosamente!'
                            }).then(function() {
                                window.location = "index.php";
                            });
                        </script>
    <?php
				    }
					break;
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