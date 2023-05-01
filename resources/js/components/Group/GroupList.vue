<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Group</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-10 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3>Group list <RouterLink :to="{name:'add_group'}" class="btn btn-primary float-right">Add Group</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="groups.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th><input type="checkbox" v-model="selectAll"> Select All
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="selected.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(group, index) in groups" :key="group.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ group.name }}</td>
                    <td>

                      <input type="checkbox" :value="group.id" v-model="selected">


                    </td>
                    <td>
                      <RouterLink :to="{name:'edit_group', params:{id:group.id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>
                      &nbsp;<button @click="deleteData(group.id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!groups.length > 0">No data found!</h3>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->

          </div>


        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>


export default {
  name: "index",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getGroup();
  },
  data(){
    return {
      groups: [],
      selected: []
    }
  },
  computed: {
    selectAll: {
      get: function(){
        return this.groups ? this.groups.length === this.selected.length : false;
      },
      set: function(value){
        let selected = [];

        if (value){

          this.groups.forEach(group => {
            selected.push(group.id)
          })

        }
        this.selected = selected;

      }
    }
  },
  methods:{
    deleteAll(){
      let data = {
        selected: this.selected
      }
      axios.post('/group/alldel', data).then(res => {
        this.getGroup();
        this.selected = []
        Notification.success(res.data);
      })
    },
    deleteData(id){
      Swal.fire({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/group/'+id).then(res => {
            return this.groups = this.groups.filter(group => {
              return group.id !== id
            })
          })
          Swal.fire(
              'Deleted!',
              // 'Your file has been deleted.'+ id,
              'success'
          )
        }
      })
    },

    pageTitle(){
      document.title = 'Groups'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getGroup(){
      axios.get('/group').then(res => {
        this.groups = res.data
      })
    },


  } // End Method
}
</script>

<style scoped>

</style>