<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                
                <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./img/doctora.jpg')">
                <h3 class="widget-user-username text-right">{{this.form.name}}</h3>
                <h5 class="widget-user-desc text-right">{{this.form.type}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <!--her we start the experiment -->
        <div class="card-header">
            <h3 class="card-title"> Selecione un Paciente</h3>

           
          </div>
           <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>name</th>
                  <th>email</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users.data" :key="user.id">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  
                  <td><span class="tag tag-success">Approved</span></td>
                  <td>
                    <a href="#" >
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
      <!-- end of the experiment -->

                
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
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Antecedentes Medicos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Historial Medico</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Consulta Actual</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Shared publicly - 7:30 PM today</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->

                    
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                     
                      <!-- END timeline item -->
                      
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
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
import Form from "vform";
import axios from "axios";
import NotFound from './NotFound.vue';
export default {
  components: { NotFound },
  data() {
    return {
      editmode: false,
      users: {},
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

  mounted(){
    console.log(this.$userInfo);
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
			axios.get('api/user?page=' + page)
				.then(response => {
					this.users = response.data;
				})},
    updateUser (id)
    { this.$Progress.start();
      this.form.put('api/user/'+this.form.id)
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
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        })
        .then((result) => {
          //send request to the server
          if (result.value){
          this.form
            .delete(`api/user/${id}`) //ejemplo de como enviar las rutas y promesas
            .then(() => {
              swal.fire("Deleted!", "Your file has been deleted.", "success")
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

      if(this.$gate.isAdminORAuthor()){
        axios.get("api/user").then(({ data }) => (this.users = data));
         //axios.get("api/user").then(({ data }) => (this.users = data.data));
      }
      
      
    },

    createUser() {
      this.$Progress.start();
      this.form
        .post("api/user")
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
      axios.get('api/findUser?q=' + query)
      .then((data)=>{
        this.users = data.data;
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
