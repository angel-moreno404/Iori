<template>
    <div class="container">
        <div class="global justify-content-center">
            <!-- <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat</div> -->

                    <div class="card-body">
                        <!-- comienzo -->
                     <div class="col-md-6">

                    <div class="card direct-chat direct-chat-warning">
                        <div  class="card-header">
                        <h3 class="card-title"> Chat Global</h3>
                        <div class="card-tools">
                        <span title="3 New Messages" class="badge badge-warning">3</span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                        <i class="fas fa-comments"></i>
                        </button>
                        <button type="button" onclick="desplegar()" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                        </div>
                        </div>

                        <div class="card-body">

                        <div class="direct-chat-messages">

                       <!--  <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                        </div>

                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">

                        <div class="direct-chat-text">
                        Is this template really for free? That's unbelievable!
                        </div>

                        </div> -->


                       <!--  <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">Sarah Bullock</span>
                        <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                        </div>

                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">

                        <div class="direct-chat-text">
                        You better believe it!
                        </div>

                        </div> -->


                        <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                        </div>

                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">

                        <div class="direct-chat-text">
                        Working with AdminLTE on a great new app! Wanna join?
                        </div>

                        </div>
                        

                        <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">Sarah Bullock</span>
                        <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                        </div>

                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">

                        <div class="direct-chat-text">
                        I would love to.
                        </div>

                        </div>

                        </div>


                        <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                        <li>
                        <a href="#">
                        <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">
                        <div class="contacts-list-info">
                        <span class="contacts-list-name">
                        Count Dracula
                        <small class="contacts-list-date float-right">2/28/2015</small>
                        </span>
                        <span class="contacts-list-msg">How have you been? I was...</span>
                        </div>

                        </a>
                        </li>

                        <li>
                        <a href="#">
                        <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                        <div class="contacts-list-info">
                        <span class="contacts-list-name">
                        Sarah Doe
                        <small class="contacts-list-date float-right">2/23/2015</small>
                        </span>
                        <span class="contacts-list-msg">I will be waiting for...</span>
                        </div>

                        </a>
                        </li>

                      
                        </ul>

                        </div>

                        </div>

                        <div class="card-footer">
                        <form action="#" method="post">
                        <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-append">
                        <button type="button" class="btn btn-warning">Send</button>
                        </span>
                        </div>
                        </form>
                        </div>

                </div>

            </div>
                        <!-- final -->
                <!--     </div>
                </div> -->
            </div>
        </div>
    </div>
</template>
<script>
import Vue from "vue";
import vSelect from "vue-select";

Vue.component("v-select", vSelect);
import "vue-select/dist/vue-select.css";
    export default {
      
      data() {
        return {
          editmode:false,
          fruits:["Mangoo","Apple","Orange","Melon","Pineapple","Lecy","Blueberry"],
          modelos:["Mangoo","Apple","Orange","Melon","Pineapple","Lecy","Blueberry"],
          canales:{},
          form: new Form({
            id:'',
            nombreSala:'',
            admingrupo:'',
            usuarioSelecionado:'',
            search:'',
          })
        }
      },
      mounted(){
        this.cargarCanales();
      },

      created() {
          Fire.$on('searching',() => {
            this.$Progress.start();
            let query = this.form.search;
            axios.get('api/busCanales?q=' + query)
            .then((data) => {
              this.canales = data.data;
              this.$Progress.finish();
            })
            .catch(() => {
              this.$Progress.fail();
            })
          })
          Fire.$on('AfterCreate',() => {
          this.cargarCanales();
          });/*setInterval(() => this.cargarCanales(), 3000); // Vue Refrescar los datos de la tabla cada 3s(Metodo alterno)*/
      },

      methods: {
        desplegar(){
            console.log(llegue);
        },



















        buscar:_.debounce(() => {
          Fire.$emit('searching');
        },500),

        getResults(page = 1) {
        axios.get('api/canal_compra?page=' + page)
          .then(response => {
            this.canales = response.data;
          });
        },

        cargarCanales(){
         /*  if (this.$gate.esAdmin()) {
          axios.get("api/canal_compra").then(({ data }) => (this.canales = data));
          } */
        },

        editarCanalModalAdm(canal){
          this.editmode = true;
          this.form.reset();
          $('#addCanal').modal('show');
          this.form.fill(canal);
        },

        crearCanalModalAdm(){
          this.editmode = false;
          this.form.reset();
          $('#addCanal').modal('show');
        },

        updateCanal(){
          this.$Progress.start();
          this.form.put('api/canal_compra/'+this.form.id)
          .then(() => { // Validacion exitosa
          $('#addCanal').modal('hide')
          swal(
                  '¡Editado!',
                  'El usuario ha sido editado.',
                  'success'
                  )
          this.$Progress.finish();
          Fire.$emit('AfterCreate'); // Funcion para recargar nuevos datos en la pagina sin refrescar
          })
          .catch(() => { // Validacion con error
            this.$Progress.fail();
            toast({
            type: 'error',
            title: 'Verifique los datos ingresados.'
            })
          });
        },

        deleteCanal(id){
          swal({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Borrar'
          }).then((result) => {
            // Enviar request al servidor
            if (result.value) {
              this.$Progress.start();
              this.form.delete('api/canal_compra/'+id).then(() => {
                swal(
                  '¡Eliminado!',
                  'El usuario ha sido eliminado.',
                  'success'
                  )
                Fire.$emit('AfterCreate');
                this.$Progress.finish();

              }).catch(() => {
                this.$Progress.fail();
                swal('¡Error!', 'Algo salio mal', 'warning');
            });
          }
        })
      },

      createsala(){
        console.log('aqui');
          this.$Progress.start()
          this.form.post('api/sala')
          .then(() => { // Validacion exitosa
          $('#addCanal').modal('hide')
          swal(
                  '¡Creación exitosa!',
                  'Canal creado con éxito.',
                  'success'
                  )
          Fire.$emit('AfterCreate'); // Funcion para recargar nuevos datos en la pagina sin refrescar
          this.$Progress.finish();
          })
          .catch(() => { //Validacion con error
            toast({
              type: 'warning',
            title: 'Verifique los datos ingresados.'
            })
            this.$Progress.fail();
          })
        },
      }, 
    }
</script>
<style>
.global{


    /* background-color: #343a40; */
    color: #fff;
    position: fixed;
    bottom: 0;
    left: 350px;
    right: 0;
    z-index: 9997;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    height: 500px;
}


</style>