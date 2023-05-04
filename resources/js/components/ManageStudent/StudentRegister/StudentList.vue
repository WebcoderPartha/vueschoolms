<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student List</h1>
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
                <h3>Student List <RouterLink :to="{name:'studentadd'}" class="btn btn-primary float-right">Add Student</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="studentAll.length > 0">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Class</th>
                    <th>Roll</th>
                    <th>Image</th>
                    <th><input type="checkbox" v-model="selectAll"> Select All
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="checkBox.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(student, index) in studentAll" :key="index+1">
                    <td>{{ student.student.id_number }}</td>
                    <td>{{ student.student.name }}</td>
                    <td>{{ student.year.name }}</td>
                    <td>{{ student.student_class.name }}</td>
                    <td>{{ student.roll_number }}</td>
                    <td><img width="60" :src="imagePath(student.student.image)" alt=""></td>
                    <td>

                      <input type="checkbox" :value="student.student_id" v-model="checkBox">


                    </td>
                    <td>
                      <RouterLink :to="{name: 'studentedit', params:{id:student.student_id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>&nbsp;
                      <RouterLink :to="{name: 'studentdetail', params:{id:student.student_id}}" class="badge bg-primary"><i class="fa fa-eye"></i></RouterLink>
                      &nbsp;<button @click="deleteData(student.student_id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!studentAll.length > 0">No data found!</h3>
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
  name: "StudentList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getStudents();
  },

  data(){
    return {

      studentAll: [],
      checkBox: [],

    }
  },
  computed: {
    selectAll: {
      get:function (){
        return this.studentAll ? this.studentAll.length === this.checkBox.length : false
      },
      set: function (value){

        let arrayValue = [];
        if (value){
          this.studentAll.forEach(student => {
            arrayValue.push(student.student.id)
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
          axios.post('/student/alldel', data).then(res => {
            this.getStudents();
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
          axios.delete('/student/'+id).then(res => {
            this.getStudents()
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
      document.title = 'Student list'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getStudents(){
      axios.get('/student').then(res => {

        this.studentAll = res.data;
        console.log(this.studentAll)
      })
    },
    imagePath(path){
      return '/'+path
    }

  } // End Method
}
</script>

<style scoped>

</style>