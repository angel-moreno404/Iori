<style>
.widget-user-header{
background-position: center center ;
background-size: cover;
height: 1000px;
}

</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                
                <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./img/CDI.jpg')">
                <h3 class="widget-user-username text-right">{{this.form.name}}</h3>
                <h5 class="widget-user-desc text-right">{{this.form.type}}</h5>
              </div>
              <div class="widget-user-image">
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
             <!-- here i go to put the rest of the view-->
             <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Perfil de Usuario</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                  <!-- /.tab-pane -->
                 
                  <!-- /.tab-pane -->

                  <div class="tab-pane active" id="settings" >
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" v-model="form.name" class="form-control" id="inputName" placeholder="Name"
                            :class="{ 'is-invalid': form.errors.has('name') }">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"
                          :class="{ 'is-invalid': form.errors.has('email') }">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Biografia</label>
                        <div class="col-sm-10">
                          <input type="text" v-model="form.bio" class="form-control" id="inputName2" placeholder="biografia">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <!--begin this is to loadding photo-->
                      <div class="form-group">
                        <label for= "photo" class ="col-sm-2 control-label"> profile photo </label>
                          <div class="col-sm-12">
                            <input type="file" @change="updateProfile" name="photo" class="form-input">
                          </div>
                      </div>    
                         <!-- this is to loadding photo end-->

                      <!-- this is to loadding photo end-->
                      <div class="form-group">
                          <label for="passport" class="col-sm-12 control-label"> password leave empty if not changing</label>
                           <div class="col-sm-12">
                            <input type="passport" v-model="form.password" class="form-control" id="password"
                              placeholder ="Password" 
                              :class="{ 'is-invalid': form.errors.has('password') }">
                            </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                <!--    </form>                  -->     
                <!-- this is to loadding photo end -->
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {

      data() {
    return {
      editmode: false,
      users: {},
      usuario: {},
      form: new Form({
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

        mounted() {
            console.log('Component mounted.')
            //this.usuario = this.$userInfo;
            this.form.fill(this.$userInfo);
            
        },
      methods:{
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
        }
      },
      
            created() {
          
         // axios.get("api/profile").then(({data})=>(this.form.fill(data)));
          // setInterval(() => this.loadUsers(), 3000);
        },
        
    }
</script>
