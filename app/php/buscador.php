<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/buscador.css">
    <title>Verificación de Empleado</title>
</head>
<body>
    <div class="container">
        <div class="row" id="app">
            <div class="col-md-5 mx-auto">
                <div class="text-center my-3">
                    <div class="card p-3 shadow fndoCard">
                        <form @submit.prevent="alta">

                        
                        <div class="card-body">
                            <img src="../img/LogoUTFV.svg" class="my-3" style="width: 100px; height: 100px; border-radius: 50%;">
                            <br>
                            


<?php
error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : '';

$fechaCap = date('d-m-Y');
$horaCap = date('g:i:s a');
$fechaHoraReg = $fechaCap . ' ' . $horaCap;

    $con = new SQLite3("../data/data.db");
    $cs = $con -> query("SELECT * FROM roboticaUsr WHERE barCode = '$id'");
    while ($resul = $cs -> fetchArray()) {
        $id_data = $resul['id'];
        $lider = $resul['lider'];
        $equipo = $resul['equipo'];
        $institucion = $resul['institucion'];
        $sedeRegional = $resul['sedeRegional'];
        $categoria = $resul['categoria'];
        $barCode = $resul['barCode'];
    };


            echo '
                    <img src="../img/buscador/usr.svg" class="img-fluid rounded" style="width: 150px;">
                    </div>
                    <div class="form-group" v-html="datos"></div>
                ';


    $con -> close();
?>


                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/vue.js"></script>
    <script src="../js/axios.min.js"></script>
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                datos: '',
                notificaEstado: '',
                msgAlert: '',
                nBarCode: '<?php echo $barCode;?>'
            },
            computed: {
            },
            methods: {
                alta () {
                    axios.post('../verifica/alta.app', {
                        opcion: 2,
                        nBarCode: this.nBarCode              
                    })
                    .then(response => {
                        if (response.data === 'correcto') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Invitado Registrado!',
                                showConfirmButton: true
                            })
                            this.datos = `
                            <div class="alert alert-success text-center animate__animated animate__fadeIn" role="alert">
                                Invitado registrado a las: <span style="font-size: .7em;"><?php echo $fechaHoraReg;?></span>
                            </div>
                            <p>
                            <div class="p-2 rounded" style="text-align: left; background-color: rgba(186, 186, 186, 0.5);">

                                <b>Id: </b><i><?php echo $barCode;?></i>
                                <br>
                                <b>Institución: </b><i><?php echo $institucion?></i>
                                <br>
                                <b>Nombre: </b><i><?php echo $lider;?></i>
                                <br>
                                <b>Equipo: </b><i><?php echo $equipo;?></i>
                                <br>
                                <b>Sede Regional: </b><i><?php echo $sedeRegional;?></i>
                                <br>
                                <b>Categoría: </b><i><?php echo $categoria;?></i>
                            </div>
                        </p>
                        <div class="btn btn-success form-control disabled">Registro</div>
                            `; 
                        }else{
                            this.datos = response.data
                            // console.log(response.data)
                        }
                    })
                },

                listaDatos () {
                    axios.post('../verifica/alta.app', {
                        opcion: 1,
                        nBarCode: this.nBarCode 
                    })
                    .then(response => {
                        this.datos = response.data
                        // console.log(response.data)

                    })
                },
            },
            created () {
                this.listaDatos()
            }

        })
    </script>
</body>
</html>