<style >

</style>

<template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isAdminORAuthor()">
      <div class="col-md-12">

           <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./img/CDI.jpg')">
                  <!--  <h3 class="widget-user-username text-right">{{this.form.name}}</h3>
                <h5 class="widget-user-desc text-right">{{this.form.type}}</h5>
                 -->
               
              </div>
              <div class="widget-user-image">
                    <!-- /.col -->
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">

              </div>
              <div class="card-footer">
                <div class="row">
                 
                  <!-- /.col -->
                  
                  <!-- /.col -->
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            
        <div class="card">


            
          <div class="card-header">
            <h3 class="card-title">Tabla de Pacientes </h3>

            <div class="card-tools">
              <button
                class="btn btn-success" @click="newModal"
              >
                Ingresar Nuevo Paciente <i class="fa fa-user-plus fa-fw"></i>
              </button>
            </div>
            <!--this is to trying the search bar   -->
          

            <!--this is to trying the search bar   -->
          </div>
          <!-- /.card-header -->
          
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>nombre</th>
                  <th>apellido</th>
                  <th>cedula</th>
                  <th>tlf1</th>
                  <th>tlf2</th>
                  <th>correo</th>
                  <th>sexo</th>
                  <th>direccion</th>
                  <th>tipo</th>
                  <th>foto</th>
                  <th>estado</th>
                  <th>registered at</th>
                  <th>Modify</th>
                </tr>
              </thead>
              <tbody>
                
                <tr v-for="user in pacientes.data" :key="user.id">
                
                  <td>{{ user.id }}</td>
                  <td>{{ user.nombre }}</td>
                  <td>{{ user.apellido }}</td>
                  <td>{{ user.cedula }}</td>
                  <td>{{ user.telefono }}</td>
                  <td>{{ user.telefono2 }}</td>
                  <td>{{ user.correo }}</td>
                  <td>{{ user.sexo }}</td>
                  <td>{{ user.direccion }}</td>
                  <td>{{ user.tipo }}</td>
                  <td>{{ user.foto }}</td>
                  <td>{{ user.estado }}</td>
                  <td>{{ user.created_at | mydate }}</td>
                  <td><span class="tag tag-success">Approved</span></td>
                  <td>
                    <div class="shared-item_cards-list-image_card_component__imageWrapper">
      <div class="shared-item_cards-preview_image_component__carousel shared-item_cards-preview_image_component__singleImage" style="padding-bottom: 20%">
  <a class="shared-item_cards-preview_image_component__imageLink" data-turbo="false" data-action="analytics-event#send" data-analytics-event="[[&quot;ec:addProduct&quot;,{&quot;brand&quot;:&quot;DotJS&quot;,&quot;category&quot;:&quot;themeforest.net/site-templates/admin-templates&quot;,&quot;id&quot;:21596795,&quot;list&quot;:&quot;Search Results: Category&quot;,&quot;name&quot;:&quot;Tradify - Responsive Crypto and Stock Trading User Interface&quot;,&quot;position&quot;:1}],[&quot;ec:setAction&quot;,&quot;click&quot;,{&quot;list&quot;:&quot;Search Results: Category&quot;}],[&quot;send&quot;,{&quot;hitType&quot;:&quot;event&quot;,&quot;eventCategory&quot;:&quot;Ecommerce&quot;,&quot;eventAction&quot;:&quot;click&quot;,&quot;eventLabel&quot;:&quot;Product click: product list&quot;}]]" href="https://themeforest.net/item/tradify-responsive-crypto-and-stock-trading-user-interface/21596795">
      <img src="https://themeforest.img.customer.envatousercontent.com/files/273203155/main+preivew.png?auto=compress%2Cformat&amp;fit=crop&amp;crop=top&amp;w=590&amp;h=300&amp;s=16aa574f9fbf857a561eaf711e2459c4" loading="lazy" style="left: 50%" class="shared-item_cards-preview_image_component__image" alt="Tradify - Responsive Crypto and Stock Trading User Interface" title="Tradify - Responsive Crypto and Stock Trading User Interface" data-controller="image-preview" data-action="error->image-preview#setFallback" data-fallback="https://previews.customer.envatousercontent.com/files/273203155/main%20preivew.__large_preview.png" data-carousel-target="image" width="200" height="150">
</a></div>

      
    </div>
    
                    <a href="#" @click="editModal(user)">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    /
                    <a href="#" @click="deleteUser(user.id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        <div class="card-footer"> 

          <pagination :data="pacientes" @pagination-change-page="getResults"></pagination>

           
        
        </div>

        </div>
        <!-- /.card -->
      </div>
    </div>

  <div v-if="!$gate.isAdminORAuthor() ">  <not-found></not-found>  
   </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="addnew"
      tabindex="-1"
      aria-labelledby="addnewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="addnewLa bel">Ingresando Paciente</h5>
            <h5 class="modal-title" v-show="editmode" id="addnewLa bel">Actualizando Datos del Paciente </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <form @submit.prevent="editmode ? updateUser () : createUser()">
            <div class="modal-body">
              <!-- nombre -->
              <div class="form-group">
                <input
                  v-model="form.nombre"
                  type="text"
                  name="nombre"
                  placeholder="nombre"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('nombre') }"
                />
                <has-error :form="form" field="nombre"></has-error>
              </div>
               <!-- apellido -->
              <div class="form-group">
                <input
                  v-model="form.apellido"
                  type="text"
                  name="apellido"
                  placeholder="apellido"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('apellido') }"
                />
                <has-error :form="form" field="apellido"></has-error>
              </div>
               <!-- cedula -->
              <div class="form-group">
                <input
                  v-model="form.cedula"
                  type="text"
                  name="cedula"
                  placeholder="cedula"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('cedula') }"
                />
                <has-error :form="form" field="cedula"></has-error>
              </div>
               <!-- telefono -->
              <div class="form-group">
                <input
                  v-model="form.telefono"
                  type="text"
                  name="telefono"
                  placeholder="telefono"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('telefono') }"
                />
                <has-error :form="form" field="telefono"></has-error>
              </div>
               <!-- telefono2 -->
              <div class="form-group">
                <input
                  v-model="form.telefono2"
                  type="text"
                  name="telefono2"
                  placeholder="telefono2"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('telefono2') }"
                />
                <has-error :form="form" field="telefono2"></has-error>
              </div>
              <!-- correo -->
              <div class="form-group">
                <input
                  v-model="form.correo"
                  type="email"
                  name="correo"
                  placeholder="correo"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('correo') }"
                />
                <has-error :form="form" field="correo"></has-error>
              </div>
              <!-- sexo -->
              <div class="form-group">
                <input
                  v-model="form.sexo"
                  type="text"
                  name="sexo"
                  placeholder="sexo"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('sexo') }"
                />
                <has-error :form="form" field="sexo"></has-error>
              </div>
              <!-- direccion -->
              <div class="form-group">
                <input
                  v-model="form.direccion"
                  type="text"
                  name="direccion"
                  placeholder="direccion"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('direccion') }"
                />
                <has-error :form="form" field="direccion"></has-error>
              </div>
              <!-- tipo -->
              <div class="form-group">
                <select
                  name="tipo"
                  v-model="form.tipo"
                  id="tipo"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('tipo') }"
                >
                  <option value="">Admin</option>
                  <option value="admin">Admin</option>
                  <option value="user">Paciente</option>
                  <option value="author">Paciente Especial</option>
                </select>

                <has-error :form="form" field="tipo"></has-error>
              </div>
              <!-- foto -->
              <div class="form-group">
                <input
                  v-model="form.foto"
                  type="text"
                  name="foto"
                  placeholder="foto"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('foto') }"
                />
                <has-error :form="form" field="foto"></has-error>
              </div>
              <!-- estado -->
              <div class="form-group">
                <input
                  v-model="form.estado"
                  type="text"
                  name="estado"
                  placeholder="estado"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('estado') }"
                />
                <has-error :form="form" field="estado"></has-error>
              </div>
              
              
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
                <button v-show= "editmode" type="submit" class="btn btn-primary">update</button>
                <button v-show= "!editmode" type="submit" class="btn btn-primary">Create</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
import Form from "vform";
import axios from "axios";
import NotFound from './NotFound.vue';
export default {
  components: { NotFound },
  data() {
    return {
      editmode: false,
      
      pacientes: {},
        users: {},
      usuario: {},
      form: new Form({
        id: "",
        nombre: "",
        apellido: "",
        cedula: "",
        telefono: "",
        telefono2: "",
        correo: "",
        sexo: "",
        direccion: "",
        tipo: "",
        foto: "",
        estado: "",
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: "",
        
      }),
    };
  },


  mounted(){
    console.log(this.$userInfo);
   
  },
    mounted() {
            console.log('Component mounted.')
            //this.usuario = this.$userInfo;
            this.form.fill(this.$userInfo);
            
        },

  methods: {
      getProfilePhoto(){
        let photo = (this.form.photo.length > 200 ) ? this.form.photo :"img/profile/"+this.form.photo;
      
        return photo;
      },
        updateInfo(){
          this.$Progress.start();
           this.form.put('api/profile/')
           .then(()=>{
             Fire.$emit("AfterCreate");
             this.$Progress.finish();

           })
           .catch(()=>{
             this.$Progress.fail();
           });
        },

        updateProfile(e){
          //this is to tranlate to base64 the file
          let file = e.target.files[0];
          console.log(file);
          let reader = new FileReader();
          //let vm= this;

          if(file['size'] < 2111775 ){

          
          reader.onloadend= (file)=>{

            this.photo=reader.result;
            //console.log('RESULT', reader.result)
            this.form.photo=reader.result;
          }
            reader.readAsDataURL(file);
         // console.log('uploading');
        }
        else{
          swal({
            type:'error',
            title:'Ooops...',
            text:'you are uploading a large file please try with other more little',
          })
          
        }
        },



      

getResults(page = 1) {
			axios.get('api/paciente?page=' + page)
				.then(response => {
					this.pacientes = response.data;
				})},
    updateUser (id)
    { //console.log("here lol");
      this.$Progress.start();
      this.form.put('api/paciente/'+this.form.id)
        .then(()=>{

            swal.fire("Updated!", "Your file has been Updated.", "success")
            $("#addnew").modal("hide");
            this.$Progress.finish();
            Fire.$emit("AfterCreate");
        })
        .catch(()=>{
          this.$Progress.fail();
        });

      
      //console.log('Editing Data') 
    },

    editModal(user){
      this.editmode=true;
      this.form.reset();
      $("#addnew").modal("show");
      this.form.fill(user);
    },
    newModal(){
       this.editmode=false;
      this.form.reset();
      $("#addnew").modal("show");
    },

    deleteUser(id) {
      swal
        .fire({
          title: "Estas seguro?",
          text: "No Seras Capaz de Revertir Esto",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "SI, Borralo!",
        })
        .then((result) => {
          //send request to the server
          if (result.value){
          this.form
            .delete(`api/paciente/${id}`) //ejemplo de como enviar las rutas y promesas
            .then(() => {
              swal.fire("Borrado!", "El usurario a sido borrado.", "Sastifactoriamente")
              Fire.$emit("AfterCreate");
            })
            .catch(() => {
              swal("fallo!", "there was something wrong", "warning");
            });
        }
        });
    },

    loadUsers() {
      /* this is to the permission to block the views a allow just admin*/

      //if(this.$gate.isAdminORAuthor()){
        axios.get("api/paciente").then(( { data } ) => (this.pacientes = data));
          
         //axios.get("api/user").then(({ data }) => (this.users = data.data));
      //}
      
      
    },

    createUser() {
     
      this.$Progress.start();
      this.form
        .post("api/paciente")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addnew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Created in successfully",
          });
          this.$Progress.finish();
        })

        .catch(() => {});
    },
  },

  created() {
    //let query = this.$parent.search;
    Fire.$on('searching', () => {
      let query = this.$parent.search;
      axios.get('api/findPaciente?q=' + query)
      .then((data)=>{
        this.pacientes = data.data;
        //console.log(query);
      })
      .catch(()=>{


      })

    })

    this.loadUsers();
    Fire.$on("AfterCreate", () => {
      this.loadUsers();
    });
    // setInterval(() => this.loadUsers(), 3000);
  },
};
</script>

