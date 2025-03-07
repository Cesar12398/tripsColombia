<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Colombia Trip</title>
	<link rel="icon" href="colombia.png" type="image/png">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
	<div class="container-fluid p-1">
		<h2 class="text-center">Colombia Trip<img height="28" src="colombia.png"></h2>
	</div>

	<div class="container mt-3 col-md-3 shadow p-2 mb-3">
		<h3 class="text-center">Registro de Gastos</h3> <br>
		<form action="procesar.php" method="POST">
			<label class="form-label" for="gasto">Gasto:</label>
			<input type="hidden" id="accion" name="accion" value="agregar">
			<input type="text" class="form-control" id="gasto" name="gasto" placeholder="Ingrese Gasto" required><br>
			<label for="monto">Monto:</label>
			<input type="text" class="form-control" id="monto" name="monto" placeholder="Ingrese Monto" required><br>
			<label class="form-label" for="tipo">Tipo de Gasto:</label>
			<select class="form-control" id="tipo" name="tipo" required>
        		<option value="">Selecciona tipo de gasto:</option>
        		<option value="COMPRAS">COMPRAS</option>
        		<option value="ALCOHOL">ALCOHOL</option>
        		<option value="COMIDA">COMIDA</option>
        		<option value="GIFTS">GIFTS</option>
			</select> <br>

			<button type="submit" class="btn text-white">Guardar</button>
		</form>
	</div>
	<?php

	$query = "SELECT * FROM colombia";
	$result = $conexion->query($query);

	if ($result->num_rows > 0) {
		?>
		<div class="container mt-3 table-responsive">
			<table class="table table-hover text-center">
				<thead>
					<tr>
						<th>#</th>
						<th>FECHA</th>
						<th>GASTO</th>
						<th>TIPO</th>
						<th>BASE</th>
						<th>IVA (21%)</th>
						<th>MONTO</th>
						<!-- <th>OCULTAR</th> -->
					</tr>
				</thead>
				<tbody>
<?php

					function formato_moneda($numero) {
    					return number_format($numero, 2, ',', '.') .' €';
					}
					$counter = '';

					while ($row = $result->fetch_assoc()) {
						$counter++;

						$fecha = $row['fecha'];
						$fecha = new DateTime($fecha);
						$fecha = date_format($fecha, 'd/m/Y h:i');
						$gasto = $row['gasto'];
						$tipo = $row['tipo'];
						$monto = $row['monto'];
						$iva = 0;

						switch ($tipo) {
							case 'ALCOHOL':
								$iva = $monto * 0.42;
								$base = $monto - $iva;
								break;
							case 'COMIDA':
								$iva = $monto * 0.105;
								$base = $monto - $iva;
								break;
							case 'GIFTS':
								$iva = $monto * 0.0525;
								$base = $monto - $iva;
								break;
							default:
								$iva = $monto * 0.21;
								$base = $monto - $iva;
								break;
						}
?>
						<tr>
							<td class="wrap"><?php echo $counter; ?></td>
							<td class="wrap"><?php echo $fecha;?></td>
							<td class="wrap"><?php echo $gasto; ?></td>
							<td class="wrap"><?php echo $tipo?></td>
							<td class="wrap"><?php echo formato_moneda($base); ?></td>
							<td class="wrap"><?php echo formato_moneda($iva) ;?></td>
							<td class="wrap"><?php echo formato_moneda($monto); ?></td>
							<!-- <td class="wrap"></td> -->
						</tr>

<?php
					}

					$querysum = "SELECT SUM(monto) AS total FROM colombia";
					$result = $conexion->query($querysum);
					$result = $result->fetch_assoc();
					$limite = 800;

					if ($result['total'] >= $limite) {
						$color = "red";
					} else {
						$color = "green";
					}
	?>
			<tr>
				<td colspan="6" class="total">Total</td>
				<td style="background-color: <?php echo $color;?>"><?php echo formato_moneda($result['total']);?></td>
			</tr>
			</tbody>
		</table>
	</div>
	<?php
		}
		else {
	?>

	<div class="container col-md-3 mt-3">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">No hay Gastos Registrados</h5>
				<p class="card-text">¡Comienza a disfrutar de Colombia!</p>
			</div>
		</div>
	</div>

	<?php
        }
        $conexion->close();
    ?>

</body>
</html>