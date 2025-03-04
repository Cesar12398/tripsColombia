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

</style>
<body>
	<div class="container-fluid p-1">
		<h2 class="text-center"> <img width="50" height="50" src="colombia.png">Colombia Trip<img width="50" height="50" src="colombia.png"></h2>
	</div>

	<div class="container mt-3 col-md-3 shadow p-2 mb-3">
		<h3 class="text-center">Registro de Gastos</h3>
		<form action="procesar.php" method="POST">
			<label class="form-label" for="gasto">Gasto:</label>
			<input type="hidden" id="accion" name="accion" value="agregar">
			<input type="text" class="form-control" id="gasto" name="gasto" placeholder="Ingrese Gasto" required><br>
			<label for="telefono">Monto:</label>
			<input type="text" class="form-control" id="monto" name="monto" placeholder="Ingrese Monto" required><br>
			<button type="submit" class="btn text-white">Guardar</button>
		</form>

	</div>

		<div class="container mt-3 table-responsive">
			<table class="table table-hover text-center">
				<thead class="">
					<tr>
						<th>ID</th>
						<th>GASTO</th>
						<th>BASE</th>
						<th>IVA (21%)</th>
						<th>MONTO</th>
					</tr>
				</thead>
			</table>
		</div>

</body>
</html>