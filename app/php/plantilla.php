<?php
error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');


$id = !empty($id) ? $id : '';
$lider = !empty($lider) ? $lider : '';
$equipo = !empty($equipo) ? $equipo : '';
$institucion = !empty($institucion) ? $institucion : '';
$sedeRegional = !empty($sedeRegional) ? $sedeRegional : '';
$categoria = !empty($categoria) ? $categoria : '';
$barCode = !empty($barCode) ? $barCode : '';

// $id = '1';
// $lider = 'VALERIA IXCHEL LOPEZ MACHUCA';
// $equipo = 'MECAFLOW JUNIOR';
// $institucion = 'Tecnologico de Estudios Superiores de Jilotepec	';
// $sedeRegional = 'TESJI';
// $categoria = 'MINI SUMO NIVEL SUPERIOR';
// $barCode = 'A0001';


?>

<html>
    <head>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>
        <div class="hoja">
            <div class="nomInvitado">
                <h1><?php echo $lider;?></h1>
                <p style="font-size: 1em;"><?php echo $institucion;?></p>
            </div>
            <?php
                include('phpqrcode.php');

                $contenido = "https://robotica.utfv.net/buscador/usuario.app?id=".$barCode;
                
                // Exportamos una imagen llamado resultado.png que contendra el valor de la avriable $content
                QRcode::png($contenido,"resultado.png",QR_ECLEVEL_L,20,2);
                
                // Impresión de la imagen en el navegador listo para usarla
                echo "<div class='codigoQr'><img src='resultado.png'/></div>";
            ?>
            <div class="codigoBarras">
                    <div class="otraCodigoBarras">*<?php echo $barCode;?>*</div>
            </div>
            <div class="categoria">
                <div class="otraCategoria"><?php echo $categoria;?></div>
            </div>
            <img src="../../img/Gafetes.jpg">
        </div>
        <div class="reverso">
            <h1 style="font-size: 1em;"><?php echo $institucion;?></h1>
            <br>
            <h3 style="font-size: .9em;">Nombre: <?php echo $lider;?></h3>
            <br>
            <p style="font-size: .9em;">Equipo: <?php echo $equipo;?></p>
            <br>
            <p style="font-size: .9em;">Sede Regional: <?php echo $sedeRegional;?></p>
            <br>
            <p style="font-size: .9em;">Categoría: <?php echo $categoria;?></p>
            <br>
            <p style="font-size: .9em;">id: <?php echo $barCode;?></p>
            <br>
            <div class="otraCodigoBarras">*<?php echo $barCode;?>*</div>
        </div>
    </body>
</html>