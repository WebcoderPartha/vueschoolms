<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Leave List</h1>
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
                <h3>Leave List <RouterLink :to="{name:'addleave'}" class="btn btn-primary float-right">Add Leave</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="leaves.length > 0">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Leave Purpose</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th><input type="checkbox" v-model="selectAll"> Select All
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="checkBox.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(leave, index) in leaves" :key="index+1">
                    <td>{{ leave.employee.id_number }}</td>
                    <td>{{ leave.employee.name }}</td>
                    <td>{{ leave.purpose.leave_purpose }}</td>
                    <td>{{ leave.leave_start_date }}</td>
                    <td>{{ leave.leave_end_date }}</td>
                    <td>

                      <input type="checkbox" :value="leave.id" v-model="checkBox">


                    </td>
                    <td>
                      <RouterLink :to="{name: 'editleave', params:{id:leave.id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>&nbsp;
                      &nbsp;<button @click="deleteData(leave.id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!leaves.length > 0">No data found!</h3>
              </div>
              <!-- /.card-body -->

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
  name: "LeaveList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getLeave();
  },

  data(){
    return {

      leaves: [],
      checkBox: [],

    }
  },
  computed: {
    selectAll: {
      get:function (){
        return this.leaves ? this.leaves.length === this.checkBox.length : false
      },
      set: function (value){

        let arrayValue = [];
        if (value){
          this.leaves.forEach(leave => {
            arrayValue.push(leave.id)
          });
        }

        this.checkBox = arrayValue;

      }
    }
  },
  methods:{
    deleteAll(){

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
          let data = {
            checkBox: this.checkBox
          }
          axios.post('/examfee/alldel', data).then(res => {
            this.getLeave();
            this.checkBox = []
            Notification.success(res.data);
          })
          Swal.fire(
              'Deleted!',
              // 'Your file has been deleted.'+ id,
              'success'
          )
        }
      })

    },

    deleteData(id){

      Swal.fire({
        title: 'Are you sure?'+this.partha,
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/leave/'+id).then(res => {
            this.getLeave()
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
      document.title = 'Leave list'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getLeave(){
      axios.get('/leave').then(res => {

        this.leaves = res.data;
      })
    }

  } // End Method
}
</script>

<style scoped>

</style>