<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registration Fee</h1>
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
                <h3>Registration Fee <RouterLink :to="{name:'add_regifee'}" class="btn btn-primary float-right">Add Registration Fee</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="assignsubjects.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th><input type="checkbox" v-model="selectAll"> Select All
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="checkBox.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(assignsubject, index) in assignsubjects" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ assignsubject.student_class.name }}</td>
                    <td>

                      <input type="checkbox" :value="assignsubject.class_id" v-model="checkBox">


                    </td>
                    <td>
                      <RouterLink :to="{name: 'edit_asssub', params:{id:assignsubject.class_id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>&nbsp;
                      <RouterLink :to="{name: 'subject_deatils', params:{id:assignsubject.class_id}}" class="badge bg-primary"><i class="fa fa-eye"></i></RouterLink>
                      &nbsp;<button @click="deleteData(assignsubject.class_id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!assignsubjects.length > 0">No data found!</h3>
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
  name: "RegisterFeeList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getAssignSubjectClass();
  },
  data(){
    return {

      assignsubjects: [],
      checkBox: []
    }
  },
  computed: {
    selectAll: {
      get:function (){
        return this.assignsubjects ? this.assignsubjects.length === this.checkBox.length : false
      },
      set: function (value){

        let arrayValue = [];
        if (value){
          this.assignsubjects.forEach(assignsubject => {
            arrayValue.push(assignsubject.class_id)
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
          axios.post('/assignsubject/alldel', data).then(res => {
            this.getAssignSubjectClass();
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
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/assignsubject/'+id).then(res => {
            return this.assignsubjects = this.assignsubjects.filter(subject => {
              return subject.class_id !== id
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
      document.title = 'Assign Subject List'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getAssignSubjectClass(){
      axios.get('/assignsubject').then(res => {

        this.assignsubjects = res.data
      })
    }

  } // End Method
}
</script>

<style scoped>

</style>