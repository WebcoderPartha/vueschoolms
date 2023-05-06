<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Grade List</h1>
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
          <div class="col-md-6 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3>Grade List <RouterLink :to="{name:'gradeadd'}" class="btn btn-primary float-right">Add Grade</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th>Class Interval</th>
                    <th>Letter Grade</th>
                    <th>Grade Point</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="grade in grades" :key="grade.id">
                    <td>{{ grade.start_mark }} - {{ grade.end_mark }}</td>
                    <td>{{ grade.grade_name }}</td>
                    <td>{{ grade.grade_point }}</td>
                    <td><router-link class="btn btn-info btn-sm" :to="{name: 'editgrade', params:{id:grade.id}}"><i class="fa fa-edit"></i></router-link></td>
                  </tr>

                  </tbody>
                </table>

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
  name: "GradeList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getGrade();
  },

  data(){
    return {
      grades: []

    }
  },
  computed: {

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
        title: 'Are you sure?',
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
      document.title = 'Grade list'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getGrade(){
      axios.get('/grade').then(res => {
        this.grades = res.data;
      })
    },


  } // End Method
}
</script>

<style scoped>

</style>