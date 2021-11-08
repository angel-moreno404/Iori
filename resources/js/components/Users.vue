<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" data-toggle="modal" 
                  data-target="#addnew"> Create new users  <i class="fa fa-user-plus fa-fw"></i></button>
                 
                </div>  
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
                    <tr v-for="user in users" :key="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.type| upText}}</td>
                      <td>{{user.created_at | mydate}}</td>
                      <td><span class="tag tag-success">Approved</span></td>
                      <td>
                          <a href="#">
                              <i class="fa fa-edit blue"></i>
                              </a>
                            /
                            <a href="#">
                              <i class="fa fa-trash red"></i>
                              </a>
                      </td>
                    </tr>
                    

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
    <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="addnewLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
           <h5 class="modal-title" id="addnewLa bel">Creating Users</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
           <form @submit.prevent="createUser">
          <div class="modal-body">
                <!-- name -->
                  <div class="form-group">

                  <input v-model="form.name" type="text" name="name"
                  placeholder="Name"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"> 
                  <has-error :form="form" field="name"></has-error>
                  </div>
                  <!-- email -->
                   <div class="form-group">

                  <input v-model="form.email" type="email" name="email"
                  placeholder="Enter Email"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('email') }"> 
                  <has-error :form="form" field="email"></has-error>
                  </div>
                  

                  <!-- password -->
                   <div class="form-group">

                  <input v-model="form.password" type="password" name="password" id="password"
                  placeholder="password"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"> 
                  <has-error :form="form" field="password"></has-error>
                  </div>
                  <!-- type -->
                   <div class="form-group">

                    <select name="type" v-model="form.type" id="type"
                    
                    class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">

                     <option value="">select user role </option>
                     <option value="admin">select user role </option>
                      <option value="user">users standar </option>
                       <option value="author">Author </option>
                    </select>

                    <has-error :form="form" field="type"></has-error>
                  </div>
                   <!-- photo -->
                   <div class="form-group">

                  <input v-model="form.photo" type="text" name="photo"
                  placeholder="photo"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('photo') }"> 
                  <has-error :form="form" field="photo"></has-error>
                  </div>

                  <!--  bio -->
                   <div class="form-group">

                  <textarea v-model="form.bio" type="text" name="bio" id="bio"
                  placeholder=" short bio for users (optional)"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                  <has-error :form="form" field="bio"></has-error>
                  </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Create</button>
                  </div>
                 
                   
          </div>
           </form>
        </div>
     </div>
    </div>
     </div>
</template>



<script>
import Form from 'vform'
import axios from 'axios'
    export default {
      data(){

        return{
          users : {},
          form: new Form({
            name :'',
            email: '',
            password: '',
            type: '',
            bio: '',
            photo: ''


          })
        }
      },


      methods: {

        loadUsers(){
          axios.get("api/user").then(({ data }) => (this.users = data.data));
        },

        createUser(){
          this.$Progress.start();
          this.form.post('api/user');
          $('#addnew').modal('hide');
          Toast.fire({
          icon: 'success',
          title: 'Created in successfully'
        })
          this.$Progress.finish();
        }
      },


        created() {
            this.loadUsers();
            setInterval(() => this.loadUsers(), 3000);
        }
    }
</script>
