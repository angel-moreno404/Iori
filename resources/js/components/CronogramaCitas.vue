<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12 mt-5">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-8">
                    <h1 class="m-0 text-dark">Administración del Chat</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-4">
                   <!--  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><router-link to="/"><p>Inicio</p></router-link></li>
                      <li class="breadcrumb-item active">SIVIT</li>
                    </ol> -->
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>

            <div class="card">
              <div class="card-header">
                <!-- SEARCH FORM -->
                <div class="form-inline ml-3">
                  <div class="input-group input-group-sm"> 
                    <input class="form-control form-control-navbar" @keyup="buscar" v-model="form.search" type="search" placeholder="Buscar" aria-label="Search">
                    <div class="input-group-append">
                      <button class="btn btn-default-fix" @click="buscar">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div> 
                </div>
                <div class="card-tools">
                    <a class="btn btn-success" href="#" @click="crearCanalModalAdm"><i class="fas fa-user-plus fs-fw"></i>&nbsp; Nuevo Chat</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Nombre de la sala</th>
                    <th>administrador de la sala</th>
                    <th>n-participantes</th>
                    <th>opciones</th>
                  </tr>

                    <tr v-for="canal in canales.data" :key="canal.id">
                    <td>{{ canal.id }}</td>
                    <td>{{ canal.nombre }}</td>
                    <td>{{ canal.created_at | myDate }}</td>
                    <td>{{ canal.updated_at | myDate }}</td>
                    <td>
                        <a href="#" @click="editarCanalModalAdm(canal)"><i class="btn btn-primary fa fa-pen blue"></i></a>
                        <a href="#" @click="deleteCanal(canal.id)"><i class="btn btn-danger fa fa-trash red"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer d-flex justify-content-center">
                <pagination :data="canales" @pagination-change-page="getResults">
                  <span slot="prev-nav"><i class="fas fa-arrow-left"></i></span>
                  <span slot="next-nav"><i class="fas fa-arrow-right"></i></span>
                </pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
       
        <!-- Modal -->
        <div class="modal fade modal-open" id="addCanal" tabindex="-1" role="dialog" aria-labelledby="addCanalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 v-show="!editmode" class="modal-title" id="addCanalLabel">Nuevo Chat</h5>
                <h5 v-show="editmode" class="modal-title" id="addCanalLabel">Editar Chat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateCanal() : createsala()">
              <div class="modal-body">
                <alert-error :form="form" message="Se han encontrado algunos errores."></alert-error> 
                    <div>
                        <input v-model="form.nombreSala" type="text" name="NombreSala"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('nombreSala') }" placeholder="Nombre de la sala del chat">
                  <has-error :form="form" field="nombreSala"></has-error>
                    </div>
                
                    <v-select style="font-size 20px,  background-color:red; "
          v-model="form.admingrupo" label="admingrupo" :reduce="modelo => modelo.id" :options="modelos" placeholder="seleccione el admin del grupo" ></v-select>
                    <!-- vselect -->
                   <div>
       <!--              <v-select options =fruits[] > </v-select > -->
       <!--  <v-select style="font-size 20px,  background-color:red; "
          v-model="form.usuarioSelecionado" 
        :class="{ 'is-invalid': form.errors.has('modelo_equipo_selecionado')}" 
         label="name" :reduce="modelo => modelo.id" :options="modelos" placeholder="seleccione a los participantes"></v-select>
         -->
                   </div>
                   <!--  <div>
                        <button v-show="!editmode" type="submit" class="btn btn-success">+ Agregar</button>
                    </div> -->
                    <!--  -->
                 <!--    <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                  <tr>
                    <th>ID</th>
                    <th>usuario</th>
                    <th>opciones</th>
                  </tr>

                    <tr v-for="canal in canales.data" :key="canal.id">
                    <td>{{ canal.id }}</td>
                    <td>{{ canal.nombre }}</td>
                    <td>{{ canal.created_at | myDate }}</td>
                    <td>{{ canal.updated_at | myDate }}</td>
                    <td>
                        <a href="#" @click="editarCanalModalAdm(canal)"><i class="btn btn-primary fa fa-pen blue"></i></a>
                        <a href="#" @click="deleteCanal(canal.id)"><i class="btn btn-danger fa fa-trash red"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
              </div> -->
                    <!--  -->
                  
                    <not-found></not-found>  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Salir</button>
                <button v-show="!editmode" type="submit" class="btn btn-success">Crear</button>
                <button v-show="editmode" type="submit" class="btn btn-primary">Editar</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</template>
<script>
import Vue from "vue";
import vSelect from "vue-select";
import NotFound from './NotFound.vue';
Vue.component("v-select", vSelect);
import "vue-select/dist/vue-select.css";
    export default {
      components: { NotFound },
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