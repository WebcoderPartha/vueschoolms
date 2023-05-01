<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shift</h1>
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
                <h3>Shift list <RouterLink :to="{name:'add_shift'}" class="btn btn-primary float-right">Add Shift</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="shifts.length > 0">
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
                  <tr v-for="(shift, index) in shifts" :key="shift.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ shift.name }}</td>
                    <td>

                      <input type="checkbox" :value="shift.id" v-model="selected">


                    </td>
                    <td>
                      <RouterLink :to="{name:'edit_shift', params:{id:shift.id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>
                      &nbsp;<button @click="deleteData(shift.id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!shifts.length > 0">No data found!</h3>
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
  name: "ShiftList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getShift();
  },
  data(){
    return {
      shifts: [],
      selected: []
    }
  },
  computed: {
    selectAll: {
      get: function(){
        return this.shifts ? this.shifts.length === this.selected.length : false;
      },
      set: function(value){
        let selected = [];

        if (value){

          this.shifts.forEach(group => {
            selected.push(group.id)
          })

        }
        this.selected = selected;

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
            selected: this.selected
          }
          axios.post('/shift/alldel', data).then(res => {
            this.getShift();
            this.selected = []
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
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/shift/'+id).then(res => {
            return this.shifts = this.shifts.filter(group => {
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
      document.title = 'Shifts'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getShift(){
      axios.get('/shift').then(res => {
        this.shifts = res.data
      })
    },


  } // End Method
}
</script>

<style scoped>

</style>