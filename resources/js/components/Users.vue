<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users table</h3>

                <div class="card-tools">
                  <botton class="btn btn-success" data-toggle="modal" 
                  data-target="#addnew"> Create new users  <i class="fa fa-user-plus fa-fw"></i></botton>
                 
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
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
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
              <div class="modal-body">
        ...
           </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Create</button>
      </div>
     </div>
     </div>
</div>
    </div>
</template>



<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
