<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
session_start();

$_POST = json_decode(file_get_contents("php://input"), true);

// Entradas Form
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$nBarCode = (isset($_POST['nBarCode'])) ? $_POST['nBarCode'] : '';

$fechaCap = date('d-m-Y');
$horaCap = date('g:i:s a');
$fechaHoraReg = $fechaCap . ' ' . $horaCap;

$con = new SQLite3("../data/data.db");
	

switch ($opcion) {
	//Mostrar Lista
	case 1:
		$cs = $con -> query("SELECT * FROM roboticaUsr WHERE barCode = '$nBarCode'");
		while ($resul = $cs -> fetchArray()) {
				$id = $resul['id'];
				$lider = $resul['lider'];
				$equipo = $resul['equipo'];
				$institucion = $resul['institucion'];
				$sedeRegional = $resul['sedeRegional'];
				$categoria = $resul['categoria'];
				$barCode = $resul['barCode'];
				$asistencia = $resul['asistencia'];
				$fechaReg = $resul['fechaReg'];
			}

			if(!empty($fechaReg)){

				echo json_encode('
				<div class="alert alert-success text-center animate__animated animate__fadeIn" role="alert">
					Invitado registrado a las: <span style="font-size: .7em;">'.$fechaReg.'</span>
				</div>
				<p>
					<div class="p-2 rounded" style="text-align: left; background-color: rgba(186, 186, 186, 0.5);">

						<b>Id: </b><i>'.$barCode.'</i>
						<br>
						<b>Institución: </b><i>'.$institucion.'</i>
						<br>
						<b>Nombre: </b><i>'.$lider.'</i>
						<br>
						<b>Equipo: </b><i>'.$equipo.'</i>
						<br>
						<b>Sede Regional: </b><i>'.$sedeRegional.'</i>
						<br>
						<b>Categoría: </b><i>'.$categoria.'</i>
					</div>
				</p>
				<div class="btn btn-success form-control disabled">Registro</div>
				');

			}else{
				echo json_encode('
				<div class="alert alert-danger text-center animate__animated animate__fadeIn" role="alert">
					Invitado no registrado
				</div>
				<p>
					<div class="p-2 rounded" style="text-align: left; background-color: rgba(186, 186, 186, 0.5);">

						<b>Id: </b><i>'.$barCode.'</i>
						<br>
						<b>Institución: </b><i>'.$institucion.'</i>
						<br>
						<b>Nombre: </b><i>'.$lider.'</i>
						<br>
						<b>Equipo: </b><i>'.$equipo.'</i>
						<br>
						<b>Sede Regional: </b><i>'.$sedeRegional.'</i>
						<br>
						<b>Categoría: </b><i>'.$categoria.'</i>
					</div>
				</p>
				<button class="btn btn-success form-control">Registro</button>
				');
			}

			

		break;
	//Actualizar	
	case 2:
		$cs = $con -> query("UPDATE roboticaUsr SET asistencia = 1, fechaReg = '$fechaHoraReg' WHERE barCode = '$nBarCode'");
		echo json_encode('correcto');

		break;
}



 ?>