<?php
	//Si ya ha iniciado sesion
	require("inc/VerifiedSecurity.php");
	$tmp = VerifiedSesion();
	
	//Archivo PHP para la conexion
	$Title = "Subir Trabajo";
	require('inc/conexion.php');
    
    //obtener el ID del trabajo a inscribir
    $TrabajoID = "";
    if(!isset($_GET['Id'])){
    	header("Location: index.php");
    }
    else{
    	if($_GET['Id'] == ""){
    		header("Location: index.php");
    	}
    	else{
    		$TrabajoID = $_GET['Id'];
    	}
    }
    $consulta="SELECT * FROM trabajos WHERE TrabajoID = ".$TrabajoID;
  	$resultado=$mysqli->query($consulta);
  	if(!$resultado) {
  		haeder("Location: Trabajo.php");
  	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<!--STYLES-->
		<?php
			require("inc/_Layout/Styles.php");
		?>
		<!--SCRIPTS-->
		<?php
			require("inc/_Layout/Scripts.php");
		?>
	</head>

	<body class="blue-grey lighten-5">
		<?php
			require("inc/_Layout/MenuAside.php");
		?>
		<div class="bg indigo"></div>
		<div style="height: 72px;"></div>

		<div class="content">
			<div class="container white z-depth-1">
				<div class="row">
					<div class="col s12">
						<div class="content-title indigo white-text">
							Subir Trabajo
							<div class="content-action right">
								<a href="Trabajo.php" class="btn-floating btn-flat">
									<i class="material-icons">assignment</i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<h5>
							Subir Trabajo en formato PDF
						</h5>
					</div>
					<?php
						while($item = $resultado->fetch_assoc()) {
					?>
					<form id="formulario" method="POST" action="inc/SaveFile.php" enctype="multipart/form-data">
						<div class="col s12">
							<input type="hidden" name="Id" value="<?php echo $TrabajoID; ?>" />
							<div class="file-field input-field">
								<div class="btn indigo lighten-3">
									<span>Seleccionar</span>
									<input name="pdf" type="file" size="32" value="" />
								</div>
								<div class="file-path-wrapper">
							    	<input class="file-path validate" type="text">
							    </div>
							</div>
						</div>
						<div class="col s12">
							<table class="striped">
								<thead>
									<tr>
										<th>Propiedades</th>
										<th>Valores</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>TEMA</td>
										<td>
											<?php 
												echo $item['Tema'];
											?>
										</td>
									</tr>
									<tr>
										<td>AUTOR(ES)</td>
										<td>
											<?php
												echo $item['Autor1'];
												if(!empty($item['Autor2'])) {
													echo ', '.$item['Autor2'];

													if(!empty($item['Autor3'])) {
														echo ', '.$item['Autor3'];

														if(!empty($item['Autor4'])) {
															echo ', '.$item['Autor4'];

															if(!empty($item['Autor5'])) {
																echo ', '.$item['Autor5'];

																if(!empty($item['Autor6'])) {
																	echo ', '.$item['Autor6'];
																}
															}
														}
													}
												}
											?>
										</td>
									</tr>
									<tr>
										<td>TUTOR(ES)</td>
										<td>
											<?php
												echo $item['Tutor1'];
												if(!empty($item['Tutor2'])) {
													echo ', '.$item['Tutor2'];

													if(!empty($item['Tutor3'])) {
														echo ', '.$item['Tutor3'];
													}
												}
											?>
										</td>
									</tr>
									<tr>
										<td>ASESOR(ES)</td>
										<td>
											<?php
												echo $item['Asesor1'];
												if(!empty($item['Asesor2'])) {
													echo ', '.$item['Asesor2'];
												}
											?>
										</td>
									</tr>
									<tr>
										<td>TIPO DE TRABAJO</td>
										<td>
											<?php
												echo $item['Tipotrabajo'];
											?>
										</td>
									</tr>
									<tr>
										<td>DEPARTAMENTO</td>
										<td>
											<?php
												echo $item['departamento'];
											?>
										</td>
									</tr>
									<tr>
										<td>CARRERA</td>
										<td>
											<?php
												echo $item['carrera'];
											?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col s12">
							<br />
				            <button type="submit" class="btn deep-orange" name="Submit" value="Subir" id="dnd_upload">Guardar PDF</button>
				            <a class="btn btn-flat" href="Trabajo.php?Id=<?php echo $item['salaID']; ?>">En otro momento</a>
						</div>
					</form>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		<br />
		<br />
		<br />

    	<?php
			require("inc/_Layout/Footer.php");
		?>
	</body>
</html>