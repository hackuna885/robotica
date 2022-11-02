<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Buscador Barras</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center animate__animated animate__fadeIn" id="app">
            <div class="col-sm-11 col-lg-10 mx-auto my-5">
                <div class="row justify-content-center">

                    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-7 mx-auto">
                        <div class="card border rounded bg-light p-5">
                            <div class="card-body">
                                <form @submit.prevent="buscar">
                                    <div class="form-group">
                                        <label for="">Buscar Id:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" maxlength="5" @keyup.enter="buscar" v-model="txtBuscador" placeholder="Buscar..." id="onFocusTxt" autofocus/>
                                            <button type="submit" @click="buscar" class=" input-group-tex btn btn-success"><i class="fas fa-search fa-sm me-1"></i>Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- <div v-for="(liDatos, index) in datos">
                            <div class="card border rounded bg-light my-3" style="font-size: .8em;">
                                <div class="card-body">
                                    <p><b>id: </b> {{liDatos.barCode}}</p>
                                    <p><b>Institución: </b> {{liDatos.institucion}}</p>
                                    <p><b>Nombre: </b> {{liDatos.lider}}</p>
                                    <p><b>Sede Regional: </b> {{liDatos.sedeRegional}}</p>
                                    <p><b>Categoría: </b> {{liDatos.categoria}}</p>
                                </div>
                            </div>
                        </div> -->
                        <div class="card border rounded bg-light my-3" style="font-size: .8em;">
                            <div class="card-body">
                                <div class="form-group" v-html="datos"></div>
                                <div @click="alta" class="btn btn-success form-control" :class="btnDisabled">Registro</div>
                            </div>
                        </div>
                        


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
                txtBuscador: '',
                btnDisabled: 'disabled',
                estadoBoton: ''
            },
            computed: {
                
            },
            methods: {
                buscar () {
                    axios.post('../buscadorDosLi/buscar.app', {
                        opcion: 1,
                        txtBuscador: this.txtBuscador.toUpperCase(),
                    })
                    .then(response => {
                        this.datos = response.data,
                        this.activarBoton()
                        // this.btnDisabled = ''             
                        // console.log(response.data)

                    })
                },

                alta () {
                    axios.post('../buscadorDosLi/alta.app', {
                        opcion: 2,
                        txtBuscador: this.txtBuscador.toUpperCase()              
                    })
                    .then(response => {
                        if (response.data === 'correcto') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Invitado Registrado!',
                                showConfirmButton: true,
                                onClose: () => {  
                                    var txtBusSelect = document.getElementById("onFocusTxt");
                                    txtBusSelect.focus();
                                }
                            })
                            axios.post('../buscadorDosLi/buscar.app', {
                                opcion: 1,
                                txtBuscador: this.txtBuscador.toUpperCase(),
                                                               
                            })
                            .then(response => {
                                this.datos = response.data,
                                this.btnDisabled = 'disabled',
                                this.txtBuscador = ''                                
                                // console.log(response.data)

                            })
                        }else{
                            this.datos = response.data
                            // console.log(response.data)
                        }
                    })
                },

                activarBoton() {
                    if (document.getElementById('invitadoReg') !== null) {
                        this.btnDisabled = 'disabled'
                    }else{
                        this.btnDisabled = ''
                    }
                }
                
            },
            created () {
                
            }

        })
    </script>
</body>
</html>