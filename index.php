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
</head>
<style>
	.container-fluid {
		background-color: #FFCD00 ;
	}

	.btn{
		background-color: #003087;
	}

	.wrap{
		white-space: nowrap;
	}

	.botones{
		width: 100%;
	}

	.total{
		text-align: right;
	}
</style>
<body>
	<div class="container-fluid p-1">
		<h2 class="text-center">Colombia Trip<img height="28" src="colombia.png"></h2>
	</div>

	<div class="container mt-3 col-md-3 shadow p-2 mb-3">
		<h3 class="text-center">Registro de Gastos</h3>
		<form action="procesar.php" method="POST">
			<label class="form-label" for="gasto">Gasto:</label>
			<input type="hidden" id="accion" name="accion" value="agregar">
			<input type="text" class="form-control" id="gasto" name="gasto" placeholder="Ingrese Gasto" required><br>
			<label for="monto">Monto:</label>
			<input type="text" class="form-control" id="monto" name="monto" placeholder="Ingrese Monto" required><br>
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
				<thead class="table-dark">
					<tr>
						<th>#</th>
						<th>GASTO</th>
						<th>BASE</th>
						<th>IVA (21%)</th>
						<th>MONTO</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$counter = '';
					while ($row = $result->fetch_assoc()) {
						$counter++;
						?>
						<tr>
							<td class="wrap"><?php echo $counter; ?></td>
							<td class="wrap"><?php echo $row['gasto']; ?></td>
							<td class="wrap"></td>
							<td class="wrap"><?php echo $row['monto'] * 0.21; ?></td>
							<td class="wrap"><?php echo $row['monto']; ?></td>
						</tr>

	<?php
					}

					$querysum = "SELECT SUM(monto) AS total FROM colombia";
					$result = $conexion->query($querysum);
					$result = $result->fetch_assoc();

	?>
			<tr>
				<td colspan="4" class="total">Total</td>
				<td><?php echo $result['total'];?></td>
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