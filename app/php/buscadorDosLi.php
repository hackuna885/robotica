<?php
error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
session_start();

// Codifica el formato json
$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$txtBuscador = (isset($_POST['txtBuscador'])) ? strtoupper($_POST['txtBuscador']) : '';

// Intradas del form
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$lider = (isset($_POST['lider'])) ? $_POST['lider'] : '';
$equipo = (isset($_POST['equipo'])) ? $_POST['equipo'] : '';
$institucion = (isset($_POST['institucion'])) ? $_POST['institucion'] : '';
$sedeRegional = (isset($_POST['sedeRegional'])) ? $_POST['sedeRegional'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$barCode = (isset($_POST['barCode'])) ? strtoupper($_POST['barCode']) : '';
$asistencia = (isset($_POST['asistencia'])) ? $_POST['asistencia'] : '';
$fechaReg = (isset($_POST['fechaReg'])) ? $_POST['fechaReg'] : '';

$fechaCap = date('d-m-Y');
$horaCap = date('g:i:s a');
$fechaHoraReg = $fechaCap . ' ' . $horaCap;

// Conexion a DB
$con = new SQLite3("../data/data.db") or die("Problemas para conectar");

// Opciones del CRUD
switch ($opcion) {
    // Insertar
    case 1 :
        $cs = $con -> query("SELECT * FROM roboticaUsr WHERE barCode = '$txtBuscador'");
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
					Invitado registrado a las: <span style="font-size: .7em;" id="invitadoReg">'.$fechaReg.'</span>
			</div>
            <p>
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
            </p>
            ');
        }else{
            echo json_encode('
            <div class="alert alert-danger text-center animate__animated animate__fadeIn" role="alert">
					Invitado no registrado
			</div>
            <p>
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
            </p>

            ');
        }
        
        break;
    // Actualizar
    case 2 :
        $cs = $con -> query("UPDATE roboticaUsr SET asistencia = 1, fechaReg = '$fechaHoraReg' WHERE barCode = '$txtBuscador'");
		echo json_encode('correcto');

        break;
    // Leer
    case 4 :
        $cs = $con -> query("SELECT * FROM roboticaUsr WHERE barCode = '$txtBuscador'");
        $datos = array();
        $i = 0;

        while ($resul = $cs -> fetchArray()) {
            $datos[$i]['id'] = $resul['id'];
            $datos[$i]['lider'] = $resul['lider'];
            $datos[$i]['equipo'] = $resul['equipo'];
            $datos[$i]['institucion'] = $resul['institucion'];
            $datos[$i]['sedeRegional'] = $resul['sedeRegional'];
            $datos[$i]['categoria'] = $resul['categoria'];
            $datos[$i]['barCode'] = $resul['barCode'];
            $datos[$i]['asistencia'] = $resul['asistencia'];
            $datos[$i]['fechaReg'] = $resul['fechaReg'];
            $i++;
        
        }

        break;
}

// $datos = (isset($datos) ? $datos : '');
// echo json_encode($datos);

$con -> close();


?>