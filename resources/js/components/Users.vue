<template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isAdminORAuthor()">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Users table</h3>

            <div class="card-tools">
              <button
                class="btn btn-success" @click="newModal"
              >
                Create new users <i class="fa fa-user-plus fa-fw"></i>
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
                  <th>name</th>
                  <th>email</th>
                  <th>Type</th>
                  <th>registered at</th>
                  <th>Modify</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users.data" :key="user.id">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.type | upText }}</td>
                  <td>{{ user.created_at | mydate }}</td>
                  <td><span class="tag tag-success">Approved</span></td>
                  <td>
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

          <pagination :data="users" @pagination-change-page="getResults"></pagination>

            <span slot="prev-nav">&lt; Previous</span>
            <span slot="next-nav">Next &gt;</span>
          </pagination>
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
            <h5 class="modal-title" v-show="!editmode" id="addnewLa bel">Creating Users</h5>
            <h5 class="modal-title" v-show="editmode" id="addnewLa bel">Updating Users</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <form @submit.prevent="editmode ? updateUser () : createUser()">
            <div class="modal-body">
              <!-- name -->
              <div class="form-group">
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  placeholder="Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <!-- email -->
              <div class="form-group">
                <input
                  v-model="form.email"
                  type="email"
                  name="email"
                  placeholder="Enter Email"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <has-error :form="form" field="email"></has-error>
              </div>

              <!-- password -->
              <div class="form-group">
                <input
                  v-model="form.password"
                  type="password"
                  name="password"
                  id="password"
                  placeholder="password"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                />
                <has-error :form="form" field="password"></has-error>
              </div>
              <!-- type -->
              <div class="form-group">
                <select
                  name="type"
                  v-model="form.type"
                  id="type"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('type') }"
                >
                  <option value="">Admin</option>
                  <option value="admin">Admin</option>
                  <option value="user">Usuario</option>
                  <option value="author">Author</option>
                </select>

                <has-error :form="form" field="type"></has-error>
              </div>
              <!-- photo -->
              <div class="form-group">
                <input
                  v-model="form.photo"
                  type="text"
                  name="photo"
                  placeholder="photo"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('photo') }"
                />
                <has-error :form="form" field="photo"></has-error>
              </div>

              <!--  bio -->
              <div class="form-group">
                <textarea
                  v-model="form.bio"
                  type="text"
                  name="bio"
                  id="bio"
                  placeholder=" short bio for users (optional)"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('bio') }"
                ></textarea>
                <has-error :form="form" field="bio"></has-error>
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
