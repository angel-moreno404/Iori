<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat</div>
<!--  -->
<div class="fb-navbar">
  <div class="fb-navbar__icon">
    <i class="fab fa-facebook"></i>
  </div>
  <div class="fb-navbar__search">
    <input type="text" placeholder="Buscar en Facebook">
    <i class="fas fa-search"></i>
  </div>
  <div class="fb-navbar__menu">
    <i class="fas fa-user"></i>
    <i class="fas fa-comments"></i>
    <i class="fas fa-bell"></i>
  </div>
</div>
<!--  -->
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

<style>
.fb-navbar {
  background-color: #3b5998;
  color: #fff;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 9999;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 20px;
  height: 60px;
}

.fb-navbar__icon i {
  font-size: 30px;
}

.fb-navbar__search input[type="text"] {
  background-color: transparent;
  border: none;
  border-bottom: 1px solid #fff;
  color: #fff;
  padding: 10px;
  margin-right: 10px;
}

.fb-navbar__search i {
  font-size: 20px;
}

.fb-navbar__menu i {
  font-size: 25px;
  margin-left: 20px;
}

@media (max-width: 768px) {
  .fb-navbar {
    justify-content: center;
  }

  .fb-navbar__search {
    display: none;
  }

  .fb-navbar__menu {
    margin-right: 0;
  }

  .fb-navbar__menu i {
    margin: 0 10px;
  }
}</style>
